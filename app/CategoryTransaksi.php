<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Akunting;

class CategoryTransaksi extends Model
{
    protected $guarded = [];

    public function accountings(){
        return $this->hasMany(Akunting::class);
    }
}
