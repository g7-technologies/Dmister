<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = ['id','coin_id','transaction_id','status','amount','customer_id','created_at','updated_at'];

    public function customer_info()
    {
        return $this->belongsTo('\App\Customer','customer_id');
    }

    public function coin_info()
    {
        return $this->belongsTo('\App\Coin','coin_id');
    }
}