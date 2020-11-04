<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryTransaksi;
use App\Customer;
use App\SubCategoryAccounting;

class Akunting extends Model
{
    protected $guarded = [];

    public function ct(){
        return $this->belongsTo(CategoryTransaksi::class,'category_id');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategoryAccounting::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
