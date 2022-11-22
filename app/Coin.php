<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = ['id','name','min','max','address','status','symbol','created_at','updated_at'];
}
