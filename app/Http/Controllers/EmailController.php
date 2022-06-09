<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailController extends Controller
{
    public function sendMail(Request $request)
    {
        // dd($request);
        $email_details = EmailTemplate::where('id',$request->template_id)->first();
        if(isset($email_details))
        {
            $details = [
                'title' => $email_details->title,
                'subject' => $email_details->email_subject,
                'body' => $email_details->email_body
            ];
            // dd("tset2");
            \Mail::to($request->to)->send(new \App\Mail\SampleMail($details));
            return "email sent";
        }
        else{
            return "invalid id or email";
        }
        
    }
    public function createTemplate()
    {
        return view('emails.create-template');
    }

    public function storeTemplate(Request $request)
    {
        EmailTemplate::create([
            'title' => $request->title,
            'email_subject' => $request->email_subject,
            'email_body' => $request->email_body,
        ]);
        return redirect()->route('dashboard');
    }

}
