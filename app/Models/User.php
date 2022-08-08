<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'address',
        'phone_number',
        'department_id',
        'image',
        'education',
        'description',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAvatar(Request $request){
        $image = $request->file('image');
        $name = $image->hashName();
        $destination = public_path('/images');
        $image->move($destination, $name);

        return $name;
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function prescriptions() {
        return $this->hasMany(Prescription::class, 'user_id');
    }

    public function doctorPrescriptions() {
        return $this->hasMany(Prescription::class, 'doctor_id');
    }

    public function bookings() {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function doctorBookings() {
        return $this->hasMany(Booking::class, 'doctor_id');
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
