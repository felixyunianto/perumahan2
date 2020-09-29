<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\DetailHouse;
use App\Akunting;

class Customer extends Model
{
    protected $guarded  = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function filing(){
        return $this->hasOne(Filing::class);
    }

    public function detail_house(){
        return $this->hasMany(DetailHouse::class);
    }

    public function akunting(){
        return $this->hasMany(Akunting::class,'id_customer');
    }
}
