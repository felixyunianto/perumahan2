<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Akunting;
use App\SubCategoryAccounting;

class CategoryTransaksi extends Model
{
    protected $guarded = [];

    public function accountings(){
        return $this->hasMany(Akunting::class,'category_id');
    }

    public function subCategory(){
        return $this->hasMany(SubCategoryAccounting::class, 'category_id');
    }
}
