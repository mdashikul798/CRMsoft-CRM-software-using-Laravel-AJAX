<?php

namespace App\Model\User\Returns;

use Illuminate\Database\Eloquent\Model;

class CustomerReturn extends Model
{
    protected $fillable = ['voucherNum', 'item_name', 'sales_total', 'sales_date', 'reason', 'description', 'return_amount'];
}
