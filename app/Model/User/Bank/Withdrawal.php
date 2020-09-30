<?php

namespace App\Model\User\Bank;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['bank', 'reference', 'date', 'amount', 'description'];
}
