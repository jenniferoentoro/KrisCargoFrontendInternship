<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ParagonIE\Paseto\Exception\PasetoException;
use ParagonIE\Paseto\Keys\AsymmetricPublicKey;
use ParagonIE\Paseto\Parser;
use ParagonIE\Paseto\ProtocolCollection;
use ParagonIE\Paseto\Rules\IssuedBy;
use ParagonIE\Paseto\Rules\ValidAt;

class DashboardController extends Controller
{
    //
    public function index(Request $request) {
        // $providedToken = $request->cookie('token');
        //     $publicKey = AsymmetricPublicKey::fromEncodedString(env('PASETO_PUBLIC_KEY'));
        //     $parser = Parser::getPublic($publicKey, ProtocolCollection::v4())
        //     ->addRule(new ValidAt)
        //     ->addRule(new IssuedBy('kriscargo'));
        
    
        // try {
        //     $token = $parser->parse($providedToken);
        //     //get id from token
        //     $id = $token->getClaims()['user_id'];
        //     //give flash message with success
        //     return view('dashboard');
        // } catch (PasetoException $ex) {
        //     /* Handle invalid token cases here. */
        //     return redirect()->route('login');
        // }

        return view('dashboard');
    }
}