<?php
/**
 * Created by PhpStorm.
 * User: lpf
 * Date: 2018/1/3
 * Time: 16:42
 */

namespace App\Api\Controllers;

use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use function Symfony\Component\Console\Tests\Command\createClosure;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends BaseController
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $newUser = [
            'email'     => $request->get('email'),
            'name'      => $request->get('name'),
            'password'  => bcrypt($request->get('password')),
        ];

        $user =  User::create($newUser);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function getAuthenticateUser()
    {

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}