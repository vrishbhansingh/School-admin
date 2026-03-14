<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $table = 'teachers';
    protected $fillable = [
        'id_no',
        'school_id',
        'profile_image',
        'gender',
        'address',
        'joining_date',
        'dob',
        'blood_group',
        'teacher_name',
        'email',
        'phone',
        'address',
        'qualification',
        'experience',
    ];
}
