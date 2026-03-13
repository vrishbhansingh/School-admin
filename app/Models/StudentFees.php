<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentFees extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_fees';
    protected $fillable = [
        'school_id ',
        'student_id',
        'fee_type_id',
        'amount',
        'due_date',
        'class_id',
        'date',
        'month',
        'year',
        'status',
    ];

 
}
