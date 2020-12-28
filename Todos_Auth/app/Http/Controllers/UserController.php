<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->only([
        //     'show', 'update', 'destroy'
        // ]);

        // $this->middleware('guest')->only([
        //     'store', 'login'
        // ]);
    }

    public function login(Request $request, $msg = 'Welcome Again')
    {
        $request->validate([
            'email' => 'required|email|unique:contacts',
            'password' => 'required|min:4',
        ]);

        $contact = Contact::where('email', $request->email)->with('user')->first();
        if ($contact && Hash::check($request->password, $contact->user->password)) {
            Auth::login($contact->user);
        } else {
            return response('Invalid Credentials', 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (filter_var($request->termsChecked, FILTER_VALIDATE_BOOL)) {

            $request->validate([
                # user
                'fname' => 'required|max:100',
                'lname' => 'required|max:100',
                'dob' => 'required|date',
                'password' => 'required|min:4',
                'password_confirm' => 'required|same:password',

                # contact
                'address' => 'required|string|max:255',
                'email' => 'required|email|unique:contacts',
                'phone' => 'required|max:10|min:9',

                # country
                'country_id' => 'required|max:100',
            ]);

            $user = Country::find($request->country_id)->users()->create(
                array_merge(
                    $request->only(['fname', 'lname', 'dob']),
                    ['password' => Hash::make($request->password)]
                )
            );

            $user->contacts()->create($request->only([
                'email', 'address', 'phone'
            ]));

            Auth::login($user);
        } else {
            return response('Terms & condition should be checked', 401);
            die();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fname' => 'required|max:100',
            'lname' => 'required|max:100',
            'dob' => 'required|date',
            'password' => 'required|min:4',
            'new_password' => 'required|min:4',
            'password_confirm' => 'required|same:new_password',
        ]);


        if (Hash::check($request->password, $user->password)) {
            $user->update(
                array_merge(
                    $request->only(['fname', 'lname', 'dob']),
                    ['password' => Hash::make($request->new_password)]
                )
            );
        } else {
            return response('Incorrect Password', 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
    }
}