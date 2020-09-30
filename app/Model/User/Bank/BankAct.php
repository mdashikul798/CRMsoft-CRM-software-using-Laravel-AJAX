<?php

namespace App\Model\User\Bank;

use Illuminate\Database\Eloquent\Model;

class BankAct extends Model
{
    protected $fillable = ['deposit_id', 'withdrawal_id', 'bank', 'reference', 'date', 'amount', 'invoiceNum'];
}
