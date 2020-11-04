<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryTransaksi;

class SubCategoryAccounting extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(CategoryTransaksi::class);
    }
}
