<?php

namespace App\Model\User\Supplier;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address', 'address_2'];
}
