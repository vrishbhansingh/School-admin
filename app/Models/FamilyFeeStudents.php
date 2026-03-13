<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FamilyFeeStudents extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'family_fee_students';
    protected $fillable = [
        'school_id ',
        'family_id',
        'payment_id',
        'class_id',
        'student_id',
        'fee_amount',
        'month',
        'year',
        'status',
    ];

 
}
