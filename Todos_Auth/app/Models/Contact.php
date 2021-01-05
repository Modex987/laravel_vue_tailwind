<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;


    protected $fillable = ['address', 'email', 'phone', 'fname', 'lname', 'country_id', 'dob'];

    protected $casts = [
        'dob' => 'date',
    ];

    protected $hidden = [
        'user_id',
        'created_at',
    ];

    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::create($updated_at)->diffForHumans();
    }

    public function getDobAttribute($dob)
    {
        return Carbon::parse($dob)->format('d-m-Y');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}