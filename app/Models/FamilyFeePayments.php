<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FamilyFeePayments extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'family_fee_payments';
    protected $fillable = [
        'school_id ',
        'parent_id',
        'total_due',
        'discount',
        'paid_amount',
        'date',
        'payment_mode',
        'status',
    ];

 
}
