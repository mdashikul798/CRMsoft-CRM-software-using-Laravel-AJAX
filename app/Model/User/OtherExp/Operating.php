<?php

namespace App\Model\User\OtherExp;

use Illuminate\Database\Eloquent\Model;

class Operating extends Model
{
    protected $fillable = ['expense_category', 'expense_name', 'date', 'amount', 'bank', 'reference', 'description', 'token', 'status'];
}
