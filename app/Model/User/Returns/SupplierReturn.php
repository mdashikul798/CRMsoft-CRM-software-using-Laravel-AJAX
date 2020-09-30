<?php

namespace App\Model\User\Returns;

use Illuminate\Database\Eloquent\Model;

class SupplierReturn extends Model
{
    protected $fillable = ['item_code', 'item_name', 'supplier_name', 'purchase_total', 'purchase_date', 'reason', 'description', 'return_amount', 'token'];
}
