<?php

namespace App\Model\User\Sale;

use Illuminate\Database\Eloquent\Model;

class OtherSale extends Model
{
    protected $fillable = ['invoiceNum', 'item_name', 'customer_name', 'phone', 'price', 'amountDue', 'description', 'total'];

    /*public function viewSale(){
    	return $this->hasMany(ViewSale::class);
    }*/
}
