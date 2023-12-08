<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Http\Resources\UserResource;
use App\Models\Staff;
use App\Models\User;
use App\Notifications\ChangePassword;
use App\Notifications\LoginSuccess;
use App\Notifications\PasswordReset;
use App\Notifications\SuccessRegistration;
use App\Services\UserNotificationLogger;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use JsonResponse;

    public function register(Request $request)
    {
        return DB::transaction(function () use ($request){
            $rules = [
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'first_name' => 'required|string|max:500',
                'last_name' => 'required|string|max:500',
                'user_role_id' => 'required|integer|exists:user_roles,id',
                'profile_picture' => 'nullable|string|max:500',
            ];

            $validated = $request->validate($rules);
            $validated['password'] = bcrypt($request->password);

            $user = User::create($validated);

            try {
                $user->notify(new SuccessRegistration($user));
            } catch (Exception $e) {
                Log::alert($e);
            }

            return $this->success(['user' => $user], 201);
        });
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();

            if ($user->email_verified_at && $user->is_active) {

                try {
                    $user->notify(new LoginSuccess($user));
                } catch (Exception $e) {
                    Log::alert($e);
                }

                return response()->json(
                    [
                        'access_token' => $user->createToken('access_token')->plainTextToken,
                        'token_type' => 'Bearer',
                        'user' => new UserResource($user)
                    ],
                    200
                );
            }
            return response()->json('User is inactive or not verified', 401);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function profile(Request $request)
    {
        $user = auth()->user();
        return new UserResource($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success(null);
    }

    public function meChangePassword(Request $request)
    {
        $payload = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6'
        ]);

        $oldPassword = $payload['old_password'];
        $newPassword = $payload['new_password'];

        // Get user from DB
        $user = User::findOrFail(auth()->user()->id);

        // Check if the current password supplied matches with DB
        if (!Hash::check($oldPassword, $user->password)) {
            return $this->error('The current password supplied is incorrect. Please check and try again.', 400);
        }

        // Update new password
        $newPasswordHash = bcrypt($newPassword);
        $user->password = $newPasswordHash;
        $user->save();

        try {
            $user->notify(new ChangePassword($user));
        } catch (Exception $e) {
            Log::alert($e);
        }

        return $this->success("Password changed successfully!");
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error('User not found', 404);
        }

        if ($user->user_type->value !== UserType::ADMIN->value) {
            return $this->error('Staff with email ' . $user->email . ' could not be found', 404);
        }
        // generate password
        $password = Str::random(8);
        $user->password = bcrypt($password);
        $user->save();

        try {
            $user->notify(new PasswordReset($user));
        } catch (Exception $e) {
            Log::alert($e);
        }

        return $this->success([
            "success" => true
        ]);
    }

    // public function staffResetPassword(Request $request)
    // {
    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {

    //         return $this->success([
    //             'email_exist' => false
    //         ]);
    //     }

    //     if ($user->user_type->value !== UserType::STAFF->value) {
    //         return $this->success([
    //             'email_exist' => false
    //         ]);
    //     }

    //     $token_exit = PasswordResetToken::where('email', $request->email);

    //     if ($token_exit) {
    //         $token_exit->delete();
    //     }

    //     $reset_token = new PasswordResetToken();
    //     $reset_token->email = $user->email;
    //     $reset_token->reset_token = uniqid('hca_');
    //     $reset_token->save();


    //     $recipient = $user->email;

    //     $details = [
    //         'user' => $user,
    //         'subject' => 'Password Reset',
    //         'content' => "You've requested for password reset @ " . now() . "., click the link bellow to procceed with the password reset. If this action wasn't performed by you, please contact the administrator.",
    //         'action_link' => env('APP_URL') . '/staff/reset-password/verify/' . $reset_token->reset_token
    //     ];

    //     try {
    //         Mail::to($recipient)->queue(new PasswordReset($details));
    //     } catch (Exception $e) {
    //     }

    //     return $this->success([
    //         "email_exist" => true
    //     ]);
    // }

    // public function verifyResetToken(Request $request)
    // {
    //     $token = $request->token;
    //     $resetTokenRecord = PasswordResetToken::where('reset_token', $token)->first();

    //     if (!$resetTokenRecord) {
    //         return $this->error('Invalid token', 404);
    //     }


    //     $reset_token = $resetTokenRecord->reset_token;
    //     return redirect(env('CLIENT_URL') . '/auth/forgot-password/update/' . $reset_token)->with('success', 'Password verified successfully');
    // }

    // public function updatePassword(Request $request)
    // {
    //     $token = $request->token;
    //     $reset_token = PasswordResetToken::where('reset_token', $token)->first();
    //     if ($reset_token) {
    //         $user = User::where('email', $reset_token->email)->first();

    //         if ($user->user_type->value !== UserType::STAFF->value) {
    //             return $this->error([
    //                 'message' => "Invalid Operation!"
    //             ]);
    //         }

    //         $user->password = bcrypt($request->password);
    //         $user->save();

    //         $reset_token->delete();

    //         $recipient = $user->email;

    //         $details = [
    //             'user' => $user,
    //             'subject' => 'Password Change Successfully',
    //             'content' => "Your password was changed successfully @ " . now() . ". If this action wasn't performed by you, please contact the administrator.",
    //             'action_link' => env('CLIENT_URL') . '/auth/login'
    //         ];

    //         try {
    //             Mail::to($recipient)->queue(new CustomerPasswordChangeSuccess($details));
    //         } catch (Exception $e) {
    //         }


    //         return $this->success([
    //             'message' => 'Password was changed successfully!',
    //         ]);

    //         // return redirect(env('CLIENT_URL') . '/login')->with('success', 'Email verified successfully');
    //     } else {
    //         return $this->error('Invalid token', 404);
    //     }
    // }
}
