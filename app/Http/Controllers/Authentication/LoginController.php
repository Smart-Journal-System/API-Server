<?php

namespace App\Http\Controllers\Authentication;

// Model imports
use App\User;

// Application-specific imports
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

// Laravel-specific imports
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// Misc
use JWTAuth;
use Response;

class LoginController extends Controller
{
    // Utilize our trait
    use AuthenticatesUsers;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
    }


    /**
     * Using Request input, log a User in - generating a token for use on our API
     * @param  Request $request
     * @return JSON    HTTP JSON response, either carrying a success or failure
     */
    public function signIn(Request $request)
    {
        $validator = $this->validator($request->all());

        try {
            $validator->validate();
        } catch (\Exception $e) {
            return Response::json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $validator->errors()
            ], 500);
        }

        // Retrieve a User from the database, using the "username" passed in;
        // because we want to offer flexibility, we will be querying on both the
        // "email" or "username" fields
        $user = User::where('username', $request->username)
            ->orWhere('email', $request->username)->first();

        // If there is no User object at this point, it's likely that there was
        // an error in the request input; we want to offer an insightful JSON response
        if (is_null($user)) {
            return Response::json([
                'status' => false,
                'message' => 'Username or Email are invalid'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            $this->incrementLoginAttempts($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            return Response::json([
                'status' => false,
                'message' => 'Username or Password are invalid'
            ]);
        }

        // Because we authenticated manually, we can call the "fromUser" method
        // on our JWTAuth class; this will generate a JWT that we can distribute
        // back to the consumer
        $token = JWTAuth::fromUser($user);

        return Response::json([
            'status' => true,
            'jwt' => $token,
            'user' => new UserResource($user),
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'token_type' => 'bearer',
        ]);
    }

    public function signInJWT(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            $user = JWTAuth::parseToken()->authenticate();

            return Response::json([
                'status' => true,
                'user' => new UserResource($user),
                'jwt' => JWTAuth::refresh($token)
            ]);
        } catch (\Exception $e) {
            return Response::json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function signOut(Request $request)
    {
        try {
            JWTAuth::parseToken()->invalidate();
        } catch (\Exception $e) {
            // Silent error - we can still return back
            // a response regardless of a token having been passed in. This ensures
            // we have an idempotent response within this endpoint.
        }

        return Response::json([
            'status' => true,
            'jwt' => null,
            'user' => null
        ]);
    }
}
