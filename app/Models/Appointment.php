<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
    ];

    public function doctor() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function times() {
        return $this->hasMany(Time::class);
    }
}
