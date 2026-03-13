<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentAddmission extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_addmission';
    protected $fillable = [
        's_no',
        'school_id',
        'parent_id',
        'class_id',
        'section_id',
        'session_id',
        'reg_no',
        'addmission_no',
        'roll_no',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender',
        'dob',
        'photo',
        'city',
        'state',
        'pincode',
        'addmission_date',
        'father_name',
        'father_phone',
        'father_phone',
        'mother_name',
        'blood_group',
        'religion',
        'nationality',
        'category',
        'aadhar_number',
        'permanent_address',
        'previous_school',
        'last_class_attended',
        'emergency_contact_name',
        'emergency_contact_number',
        'transfer_certificate',
        'status',
       
    ];

 
}
