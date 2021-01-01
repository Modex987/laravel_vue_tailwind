<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;


    protected $fillable = ['address', 'email', 'phone'];

    protected $casts = [
        'dob' => 'date',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}