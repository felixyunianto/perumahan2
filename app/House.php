<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Block;

class House extends Model
{
    protected $guarded = [];
    
    public function block(){
        return $this->belongsTo(Block::class);
    }
}
