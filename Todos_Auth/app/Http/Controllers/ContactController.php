<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->contact()->with('country')->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Contact::class);

        // Auth::user()->contact()->create($this->validateRequest($request));

        $user->contact()->create(self::validateRequest($request));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);
        // dump($contact);
        // dd($request->all());

        $contact->update($this->validateRequest($request));

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\ResponsevalidateRequest
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();
    }

    public static function validateRequest($request)
    {
        return $request->validate([
            'country_id' => 'required',
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            // 'address' => 'required|string|max:255|unique:contacts,address',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|max:10|min:9',
        ]);
    }
}