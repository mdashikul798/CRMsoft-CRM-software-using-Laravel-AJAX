<?php

namespace App\Model\User\Purchase;

use Illuminate\Database\Eloquent\Model;

class AssetPurchase extends Model
{
    protected $fillable = ['invoiceNum', 'item_name', 'supplier_name', 'quentity', 'bank', 'price', 'description', 'total', 'token'];
}
