<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }


    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'msg' => 'required|max:1000',
        ]);

        Mail::to('admin@website.com')->send(new ContactUsMail($data));

        return back()->with('status', 'Email Has Been Sent');
    }
}