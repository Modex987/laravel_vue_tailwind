<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    public function users()
    {
        return $this->hasMany(User::class);
    }
}