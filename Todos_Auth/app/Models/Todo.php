<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'date_limit' => 'date',
    ];

    public function getStatusAttribute($status)
    {
        return $status ? 'Completed' : 'Active';
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}