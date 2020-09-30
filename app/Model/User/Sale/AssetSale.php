<?php

namespace App\Model\User\Sale;

use Illuminate\Database\Eloquent\Model;

class AssetSale extends Model
{
    protected $fillable = ['invoiceNum', 'item_name', 'customer_name', 'phone', 'price', 'amountDue', 'description', 'total'];

    /*public function orders(){
    	return $this->hasMany(Order::class, 'id');
    }

    public function viewSale(){
    	return $this->hasMany(ViewSale::class);
    }*/
}
