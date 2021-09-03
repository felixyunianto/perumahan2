<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Block;
use App\DetailHouse;

class House extends Model
{
    protected $guarded = [];
    
    public function block(){
        return $this->belongsTo(Block::class);
    }

    public function detail_house(){
        return $this->hasMany(DetailHouse::class);
    }
}
