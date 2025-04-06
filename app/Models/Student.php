<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'student';

    protected $primaryKey = 'appNo';
    public $incrementing = false;
    protected $keyType = 'string'; // Set the key type to string

    protected $fillable = [
        'appNo',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'its',
        'mohallah',
        'dob',
        'program',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define attribute casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function results()
    {
        return $this->hasMany(Result::class, 'app_no', 'appNo');
    }
    
}
