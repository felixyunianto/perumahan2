<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryTransaksi;
use App\Customer;
use App\SubCategoryAccounting;
use App\SubSubCategory;
use App\Block;

class Akunting extends Model
{
    protected $guarded = [];

    public function ct(){
        return $this->belongsTo(CategoryTransaksi::class,'category_id');
    }

    public function subCategory(){
        return $this->belongsTo(SubCategoryAccounting::class);
    }

    public function subSubCategory(){
        return $this->belongsTo(SubSubCategory::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function block(){
        return $this->belongsTo(Block::class);
    }
}
