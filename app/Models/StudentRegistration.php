<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentRegistration extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_registration';
    protected $fillable = [
        'school_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'gender',
        'dob',
        'address',
        'reg_date',
        'reference',
        'class_id',
        'section_id',
        'aadhar_number',
        'city',
        'state',
        'pincode',
        'reg_amount',
        'reg_no',
        'status',
       
    ];

 
}
