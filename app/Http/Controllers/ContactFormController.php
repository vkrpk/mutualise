<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function createForm(Request $request)
    {
        return view('contact');
    }

    public function contactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required',
            'email' => 'required|email',
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'object' => 'required|string|max:255',
            'content' => 'required|string',
            'privacy_policy' => 'accepted'
        ])->validate();

        Contact::create($request->all());

        \Mail::send('mail.contact-mail', array(
            'identifier' => $request->get('identifier'),
            'email' => $request->get('email'),
            'tel' => $request->get('tel') ?? "Non renseigné",
            'object' => $request->get('object'),
            'content' => $request->get('content'),
        ), function ($message) use ($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to(['guillaume.orvoire@orange.fr', 'victor.krupka@orange.fr', 'bobrazowskitrash@gmail.com'], 'Admin')->subject($request->get('object'));
        });

        return back()->with('status', 'Nous avons reçu votre message et nous vous remercions de nous avoir contacté');
    }
}
