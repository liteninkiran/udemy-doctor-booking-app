<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'doctor_id',
        'date',
        'time',
        'status',
    ];

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
