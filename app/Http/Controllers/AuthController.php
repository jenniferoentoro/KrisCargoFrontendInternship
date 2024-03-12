<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use ParagonIE\Paseto\Builder;
use ParagonIE\Paseto\Exception\PasetoException;
use ParagonIE\Paseto\JsonToken;
use ParagonIE\Paseto\Keys\AsymmetricPublicKey;
use ParagonIE\Paseto\Keys\AsymmetricSecretKey;
use ParagonIE\Paseto\Keys\SymmetricKey;
use ParagonIE\Paseto\Parser;
use ParagonIE\Paseto\Protocol\Version4;
use ParagonIE\Paseto\ProtocolCollection;
use ParagonIE\Paseto\Purpose;
use ParagonIE\Paseto\Rules\IssuedBy;
use ParagonIE\Paseto\Rules\ValidAt;

class AuthController extends Controller
{
    public function frontLogin(Request $request)
    {
        //check if cookie is set

        return view('login');
    }
    public function frontLoginSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //pass request to login function
        $response = Http::post(env('API_URL') . '/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $responseJson = $response->json();
        //if response is not 200, return error
        if ($response->status() != 200) {
            $errorMessages = $responseJson['error'];
            return redirect()->route('login-page')->withInput()->withErrors($errorMessages);
            //the method Method Illuminate\Http\JsonResponse::json does not exist.

        }
        //return token

        $token = $responseJson['token'];
        $userName = $responseJson['user_name'];
        // set cookie for 1 day
        $cookie = cookie('token', $token, 60 * 24);

        //redirect to dashboard
        return redirect()->route('home')->cookie($cookie)->with('success', $userName);
    }



    public function logout(Request $request)
    {
        //delete cookie
        $cookie = cookie('token', null, -1);
        return redirect()->route('login-page')->cookie($cookie);
    }
}
