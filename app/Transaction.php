<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['id','customer_id','amount','transaction','order_id','created_at','updated_at'];

    public function customer_info()
    {
        return $this->belongsTo('\App\Customer','customer_id');
    }

    public function order_info()
    {
        return $this->belongsTo('\App\Order','order_id');
    }
}