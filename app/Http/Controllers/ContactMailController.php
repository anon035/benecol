<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\ContactMailRequest;

class ContactMailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request\ContactMailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ContactMailRequest $request)
    {
        if (strtolower($request->captcha) == 'tri') {
            Mail::to(['benecol@benecol.sk'])->send(new ContactMail($request->name, $request->surname, $request->email, $request->msg, $request->subject));
            return redirect()->route('contact', ['message' => 'success']);
        } else { 
            return redirect()->route('contact', ['message' => 'captcha-wrong']);
        }
    }
}
