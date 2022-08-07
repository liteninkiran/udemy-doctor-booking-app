<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_of_disease',
        'symptoms',
        'user_id',
        'doctor_id',
        'medicine',
        'procedure_to_use_medicine',
        'feedback',
        'signature',
    ];

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
