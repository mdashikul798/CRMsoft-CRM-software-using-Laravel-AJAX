<?php

namespace App\Model\User\Returns;

use Illuminate\Database\Eloquent\Model;

class AllReturn extends Model
{
    protected $fillable = ['customer_ret_id', 'supplier_ret_id', 'purchase_id'];
}
