<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StudentFeePayments extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table='student_fee_payments';
    protected $fillable = [
        'school_id ',
        'student_id',
        'class_id',
        'month',
        'year',
        'total_amount',
        'discount',
        'due_amount',
        'payment_mode',
        'receipt_no',
        'date',
        'family_plan',
        'status',
    ];

 
}
