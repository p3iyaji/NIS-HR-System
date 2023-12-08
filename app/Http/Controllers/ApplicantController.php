<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantStoreRequest;
use App\Http\Requests\ApplicantUpdateRequest;
use App\Http\Resources\ApplicantCollection;
use App\Http\Resources\ApplicantResource;
use App\Models\Applicant;
use App\Models\User;
use App\Notifications\ApplicationCompletedSuccess;
use App\Notifications\CBTInvitationSuccess;
use App\Notifications\NINVerificationSuccess;
use App\Notifications\PhysicalInvitationSuccess;
use App\Notifications\SubmitApplicationSuccess;
use App\Traits\JsonResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApplicantController extends Controller
{
    use JsonResponse;
    public $loadData = ['jobPosition', 'workExperiences', 'qualifications', 'certifications', 'jobApplication', 'references', 'shortlistedApplicant', 'geoState', 'geoLga'];

    public function index(Request $request): ApplicantCollection
    {
        $applicants = Applicant::latest()->get();

        return new ApplicantCollection(
            $applicants->load($this->loadData));
    }

    public function store(ApplicantStoreRequest $request): ApplicantResource
    {
        $validated = $request->validated();

        $user = auth()->user();
        $validated['user_id'] = $user->id;
        $validated['reg_no'] = time() . $user->id;

        $applicant = Applicant::create($validated);

        return new ApplicantResource($applicant);
    }

    public function show(Request $request, Applicant $applicant): ApplicantResource
    {
        return new ApplicantResource($applicant->load($this->loadData));
    }

    public function update(ApplicantUpdateRequest $request, Applicant $applicant): ApplicantResource
    {
        $applicant->update($request->validated());

        return new ApplicantResource($applicant);
    }

    public function destroy(Request $request, Applicant $applicant): Response
    {
        $applicant->delete();

        return response()->noContent();
    }

    public function submitApplication(Request $request)
    {
        $user = auth()->user();
        $applicant = Applicant::where('user_id', $user->id)->first();

        $applicant->is_submitted = $request->is_submitted;
        $applicant->cover_letter = $request->cover_letter;
        $applicant->save();

        try {
            $user->notify(new SubmitApplicationSuccess($user));
        } catch (Exception $e) {
            Log::alert($e->getMessage());
        }

        return new ApplicantResource($applicant->load($this->loadData));
    }

    public function adminVerifyNIN(Request $request)
    {
        $applicantion = Applicant::find($request->applicant_id);
        $user = User::find($applicantion->user_id);
        $nin = $applicantion->nin;
         // TODO verify nin

        $applicantion->is_nin_verified = true;
        $applicantion->save();

        try {
            $user->notify(new NINVerificationSuccess($user));
        } catch (Exception $e) {
            Log::alert($e->getMessage());
        }

        return $this->success('NIN Verification successful.');
    }

    public function verifyNIN(Request $request)
    {
       $nin = $request->nin;
        // TODO verify nin
    }

    public function CBTInvitation(Request $request)
    {
        $applicantion = Applicant::find($request->applicant_id);
        $user = User::find($applicantion->user_id);
        $cbt_date = $request->cbt_date;

        $applicantion->status = "Invitation For CBT";
        $applicantion->save();

        try {
            $user->notify(new CBTInvitationSuccess($user, $cbt_date));
        } catch (Exception $e) {
            Log::alert($e->getMessage());
        }

        return $this->success('Invitation for CBT successfully sent.');
    }

    public function physicalVerification(Request $request)
    {
        $applicantion = Applicant::find($request->applicant_id);
        $user = User::find($applicantion->user_id);

        $applicantion->status = "Invite For Physical Verification";
        $applicantion->interview_date = $request->interview_date;
        $applicantion->save();

        try {
            $user->notify(new PhysicalInvitationSuccess($user, $request->interview_date));
        } catch (Exception $e) {
            Log::alert($e->getMessage());
        }

        return $this->success('Physical verification successful.');
    }

    public function applicationCompleted(Request $request)
    {
        $applicantion = Applicant::find($request->applicant_id);
        $user = User::find($applicantion->user_id);

        $applicantion->status = "Application Completed";
        $applicantion->save();

        try {
            $user->notify(new ApplicationCompletedSuccess($user));
        } catch (Exception $e) {
            Log::alert($e->getMessage());
        }

        return $this->success('Application completed successful.');
    }
}
