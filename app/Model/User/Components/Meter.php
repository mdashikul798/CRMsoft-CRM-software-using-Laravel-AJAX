<?php

namespace App\Model\User\Components;

use Illuminate\Database\Eloquent\Model;

class Meter extends Model
{
    protected $fillable = ['meter_name', 'meter_number', 'description'];
}
