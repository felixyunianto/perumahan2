<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filing extends Model
{
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(Customer::class);
      }
}
