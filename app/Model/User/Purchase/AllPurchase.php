<?php

namespace App\Model\User\Purchase;

use Illuminate\Database\Eloquent\Model;

class AllPurchase extends Model
{
    protected $fillable = ['purchase_id', 'item_name', 'item_code', 'amountdue'];
}
