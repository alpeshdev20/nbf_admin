<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SendGrid\Mail\Mail;
use DB;

class EmailHelper
{
    static public function sendEmail($to, $subject, $message) 
    {
        $email = new Mail();
        $email->setFrom(env('SET_FROM_EMAIL'));
        $email->setSubject($subject);
        $email->addTo($to);
        $email->addContent("text/html", $message);
        $sendgrid = new \SendGrid(env('SEND_GRID_KEY'));
        try {
            $response = $sendgrid->send($email);
    
            if ($response->statusCode() === 202) {
                return response()->json(["message" => "Email sent successfully."]);
            } else {
                return response()->json(["error" => "Email sending failed."]);
            }
        } catch (Exception $e) {
            return response()->json(["error" => "Caught exception: " . $e->getMessage()]);
        }
    }
}



    
