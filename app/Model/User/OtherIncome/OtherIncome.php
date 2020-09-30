<?php

namespace App\Model\User\OtherIncome;

use Illuminate\Database\Eloquent\Model;

class OtherIncome extends Model
{
    protected $fillable = ['invoiceNum', 'income_name', 'customer_name', 'phone', 'bank_name', 'price', 'due', 'description', 'total', 'token'];
}
