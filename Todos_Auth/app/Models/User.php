<?php

namespace App\Models;

use App\Models\Todo;
use App\Models\Contact;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dob',
        'fname',
        'lname',
        'email',
        'phone',
        'password',
        'country',
        'callingCode',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];


    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}