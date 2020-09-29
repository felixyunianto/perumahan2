<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryTransaksi;
use App\Customer;

class Akunting extends Model
{
    protected $guarded = [];

    public function ct(){
        return $this->belongsTo(CategoryTransaksi::class,'category_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
