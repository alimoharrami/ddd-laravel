<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Http\Resources\userResource;

class ProfileController extends Controller
{
    /**
     * return auth user profile.
     */
    public function getProfile(): JsonResponse
    {
        $user = auth()->user();

        return response()->json(UserResource::make($user));
    }

    /**
     * Update auth user profile.
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $user = auth()->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'address',
            'postal_code'
        ]));

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => UserResource::make($user),
        ]);
    }
}
