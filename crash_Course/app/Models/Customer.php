<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $statusOptions = [1 => 'Active', 0 => 'Inactive', 2 => 'In-progress'];

    protected $fillable = ['name', 'email', 'status', 'company_id'];

    // protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }


    /*
    *
    * @ Accessor
    *
    */
    public function getStatusAttribute($status)
    {
        return $status !== null ? $this->statusOptions[$status] : null;
    }

    /*
    *
    * @ Mutator
    *
    */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}