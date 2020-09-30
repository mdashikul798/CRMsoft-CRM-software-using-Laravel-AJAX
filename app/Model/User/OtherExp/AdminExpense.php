<?php

namespace App\Model\User\OtherExp;

use Illuminate\Database\Eloquent\Model;

class AdminExpense extends Model
{
    protected $fillable = ['voucherNum', 'expense_name', 'amount', 'bank', 'reference', 'description', 'token'];
}
