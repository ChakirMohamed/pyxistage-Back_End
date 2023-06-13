<?php

namespace App\Http\Controllers;

use App\Mail\MailInvitation;

use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class sendInvitation extends Controller
{
    //
    public function sendInvitation(Request $request)
    {
        $email = $request->input('email');
        $dateEntretien = $request->input('dateEntretien');
        $heureEntretien = $request->input('heureEntretien');

        $user = ['name' => 'Recipient Name', 'email' => $email];

        $data = [
            'message' => 'This is the message content.',
            'dateEntretien' =>$dateEntretien,
            'heureEntretien' =>$heureEntretien,
        ];

        Mail::to($user['email'])->send(new MailInvitation($data));

        return response()->json(['message' => 'Email sent successfully']);
    }

}
