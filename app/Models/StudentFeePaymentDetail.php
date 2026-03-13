<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentFeePaymentDetail extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_fee_payment_details';
    protected $fillable = [
        'school_id ',
        'student_id',
        'fee_type_id',
        'student_fee_id',
        'amount_paid',
        'month',
        'year',
        'status',
        
    ];

 
}
