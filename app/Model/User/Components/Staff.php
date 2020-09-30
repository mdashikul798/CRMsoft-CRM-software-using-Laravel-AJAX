<?php

namespace App\Model\User\Components;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['name', 'designation', 'phone', 'nid_number', 'address', 'address_2'];
}
