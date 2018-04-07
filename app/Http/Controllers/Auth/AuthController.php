<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exception\HttpResponseException;

use App\Models\User;

class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        try {
            $this->validate($request, [
                'phone_number' => 'required|string|max:15',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $e->getResponse();
        }

        try {
            // Attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt(
                $this->getCredentials($request)
            )) {
                return $this->onUnauthorized();
            }
        } catch (JWTException $e) {
            // Something went wrong whilst attempting to encode the token
            return $this->onJwtGenerationError();
        }

        // All good so return the token
        return $this->onAuthorized($token);
    }

    /**
     * What response should be returned on invalid credentials.
     *
     * @return JsonResponse
     */
    protected function onUnauthorized()
    {
        return new JsonResponse([
            'message' => 'invalid_credentials'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * What response should be returned on error while generate JWT.
     *
     * @return JsonResponse
     */
    protected function onJwtGenerationError()
    {
        return new JsonResponse([
            'message' => 'could_not_create_token'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * What response should be returned on authorized.
     *
     * @return JsonResponse
     */
    protected function onAuthorized($token)
    {
        return new JsonResponse([
            'message' => 'token_generated',
            'data' => [
                'token' => $token,
            ]
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only('phone_number', 'password');
    }

    /**
     * Invalidate a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteInvalidate()
    {
        $token = JWTAuth::parseToken();

        $token->invalidate();

        return new JsonResponse(['message' => 'token_invalidated']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\Response
     */
    public function patchRefresh()
    {
        $token = JWTAuth::parseToken();

        $newToken = $token->refresh();

        return new JsonResponse([
            'message' => 'token_refreshed',
            'data' => [
                'token' => $newToken
            ]
        ]);
    }

    /**
     * Get authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        return new JsonResponse([
            'message' => 'authenticated_user',
            'data' => JWTAuth::parseToken()->authenticate()
        ]);
    }

    /**
     * Register new user
     * @param Request $request
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'national_id' => 'required|string|max:12',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|max:100'
        ]);

        if (!is_numeric($request->national_id)
            || !is_numeric($request->phone_number)
            || !is_numeric($request->password)) {
            return (new JsonResponse(
                ["error" => "National ID or phone number or password is not a number"],
                response::HTTP_BAD_REQUEST));
        }

        $exists = User::where('national_id', $request->national_id)
            ->orWhere('phone_number', $request->phone_number)
            ->first();

        if ($exists) {
            return (new JsonResponse(
                ['error' => 'National ID or phone number already exists'],
                response::HTTP_BAD_REQUEST));
        }

        $user = User::create([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'phone_number' => $request->phone_number,
            'password' => app('hash')->make($request->password)
        ]);

        return (new JsonResponse($user, response::HTTP_OK));
    }
}
