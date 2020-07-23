<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\House;
use App\Customer;

class DetailHouse extends Model
{
    protected $guarded = [];

    public function house(){
        return $this->belongsTo(House::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
