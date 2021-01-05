<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'body', 'status', 'date_limit'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
        'date_limit' => 'date',
        'updated_at' => 'date',
    ];

    // public function getStatusAttribute($status)
    // {
    //     return $status ? 'Completed' : 'Active';
    // }

    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::create($updated_at)->diffForHumans();
    }

    public function getDateLimitAttribute($date_limit)
    {
        if ($date_limit) {
            if (now()->greaterThan(Carbon::create($date_limit))) {
                return 'passed';
            } else {
                return Carbon::create($date_limit)->diffForHumans();
            }
        } else {
            return null;
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeActif($query)
    {
        return $query->where('status', false);
    }


    public function scopeCompleted($query)
    {
        return $query->where('status', true);
    }
}