<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\House;

class Block extends Model
{
    protected $guarded = [];

    public function house(){
      return $this->hasMany(House::class, 'block_id');
    }
}
