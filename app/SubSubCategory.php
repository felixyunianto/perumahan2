<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubCategoryAccounting;

class SubSubCategory extends Model
{
    protected $guarded = [];

    public function subCategory(){
        return $this->belongsTo(SubCategoryAccounting::class);
    }
}
