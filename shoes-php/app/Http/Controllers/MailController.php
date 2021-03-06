<?php

namespace App\Http\Controllers;
use App\Mail\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendEmail($name, $email, $verification_code){

        $data = [
            'name' => $name,
            'verification_code' => $verification_code
        ];
        Mail::to($email)->send( new Verify($data));
    }
}
