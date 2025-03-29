<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use models\User;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Resources\userResource;

class AuthController extends Controller
{
    /**
     * login with password
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['email'] = strtolower($credentials['email']);

        if (!Auth::attempt($credentials)) return response()->json(['message' => 'Invalid login credentials.',], ResponseAlias::HTTP_NOT_ACCEPTABLE);

        $user       = Auth::user();
        $roleName   = $user->roles()->first()->title;

        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => [
                'user'          => new userResource($user),
                'token'         => $token,
            ]
        ]);
    }

    /**
     * logout from account
     * @return JsonResponse
     */
    function logout(): JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json(['data' => [
            'message' => 'Successfully logged out.'
        ]
        ]);
    }

    /**
     * user register
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    function register(RegisterRequest $request): JsonResponse
    {
        $userWithEmail = User::query()->where('email', strtolower($request->email))->first();
        if($userWithEmail)
            return response()->json(['message' => "This email is already registered for the ".$userWithEmail->roles()->first()->title." role. Please use a different email."], ResponseAlias::HTTP_NOT_ACCEPTABLE);

        try{
            $user               = new User();
            $user->email        = $request->email;
            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->password     = $request->password;
            $user->save();

            //todo wallet initialize

        }catch (\Exception $e)
        {
            info($e);
            return response()->json(['message' => 'Problem creating an account please try later or contact our support.'], ResponseAlias::HTTP_NOT_ACCEPTABLE);
        }

        Auth::loginUsingId($user->id);
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'data' => [
                'user'          => new userResource($user),
                'token'         => $token,
            ]
        ]);
    }
}
