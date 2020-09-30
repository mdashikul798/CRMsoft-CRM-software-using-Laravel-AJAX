<?php

namespace App\Model\User\Purchase;

use Illuminate\Database\Eloquent\Model;

class StationaryPurchase extends Model
{
    protected $fillable = ['invoiceNum', 'item_name', 'supplier_name', 'quentity', 'description', 'reference', 'total'];
}
