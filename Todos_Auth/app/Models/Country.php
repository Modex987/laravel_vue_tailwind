<?php

namespace App\Models;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'callingCode1', 'callingCode2', 'countryCode'];


    protected $hidden = [
        'created_at',
        'updated_at',
        'callingCode1',
        'callingCode2',
        'countryCode',
        'name',
    ];


    protected $appends = ['calling_codes', 'country_name'];


    public function getCallingCodesAttribute()
    {
        return [
            $this->callingCode1,
            $this->callingCode2,
        ];
    }

    public function getCountryNameAttribute()
    {
        return $this->name . ', ' . $this->countryCode;
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Contact::class);
    }
}