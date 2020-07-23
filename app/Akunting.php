<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CategoryTransaksi;

class Akunting extends Model
{
    protected $guarded = [];

    public function ct(){
        return $this->belongsTo(CategoryTransaksi::class);
    }
}
