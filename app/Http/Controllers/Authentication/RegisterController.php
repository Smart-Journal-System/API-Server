<?php

namespace App\Http\Controllers\Authentication;

use JWTAuth;
use Response;

use App\User;
use App\Organization;

use App\Http\Controllers\Controller;

// Laravel-specific imports
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $organization = Organization::create([
            'name' => 'Organization',
        ]);

        return User::create([
            'organization_id' => $organization->id,
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function signUp(Request $request)
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

        $user = $this->create($request->all());

        if (!is_null($user)) {
            // Because we authenticated manually, we can call the "fromUser" method
            // on our JWTAuth class; this will generate a JWT that we can distribute
            // back to the consumer
            $token = JWTAuth::fromUser($user);

            return Response::json([
                'status' => true,
                'user' => $user,
                'jwt' => $token
            ]);
        }
    }
}
