<?php

namespace App\Model\User\Purchase;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $fillable = ['invoiceNum', 'category_id', 'item_code', 'item_name', 'customer_name', 'bank_name', 'customer_phone', 'quentity', 'price', 'discount', 'amountdue', 'total'];
}
