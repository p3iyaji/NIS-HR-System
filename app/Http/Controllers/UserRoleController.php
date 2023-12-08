<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRoleStoreRequest;
use App\Http\Requests\UserRoleUpdateRequest;
use App\Http\Resources\UserRoleCollection;
use App\Http\Resources\UserRoleResource;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRoleController extends Controller
{
    public function index(Request $request): UserRoleCollection
    {
        $userRoles = UserRole::all();

        return new UserRoleCollection($userRoles);
    }

    public function store(UserRoleStoreRequest $request): UserRoleResource
    {
        $userRole = UserRole::create($request->validated());

        return new UserRoleResource($userRole);
    }

    public function show(Request $request, UserRole $userRole): UserRoleResource
    {
        return new UserRoleResource($userRole);
    }

    public function update(UserRoleUpdateRequest $request, UserRole $userRole): UserRoleResource
    {
        $userRole->update($request->validated());

        return new UserRoleResource($userRole);
    }

    public function destroy(Request $request, UserRole $userRole): Response
    {
        $userRole->delete();

        return response()->noContent();
    }
}
