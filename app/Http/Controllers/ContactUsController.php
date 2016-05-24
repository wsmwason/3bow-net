<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Mail;

class ContactUsController extends Controller
{

    /**
     * 聯絡我們
     */
    public function create()
    {
        $this->setPageTitle('聯絡我們');
        return view('contact.contact_us');
    }

    /**
     * 送出聯絡
     */
    public function store(ContactUsRequest $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $description = $request->get('description');
        Mail::raw($description, function($message) use ($email, $name)
        {
            $message->from($email, $name)
                    ->subject('聯絡我們: ' . $name)
                    ->to(env('WEBMASTER_MAIL'));
        });
        return redirect()->route('contact.success');
    }

    /**
     * 送出成功
     */
    public function success()
    {
        return view('contact.contact_success');
    }

}
