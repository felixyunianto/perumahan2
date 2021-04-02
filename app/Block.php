<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\House;
use App\Akunting;

class Block extends Model
{
    protected $guarded = [];

    public function house(){
      return $this->hasMany(House::class, 'block_id');
    }

    public function accountings(){
      return $this->hasMany(Akunting::class, 'block_id');
    }
}
