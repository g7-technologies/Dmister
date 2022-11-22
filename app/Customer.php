<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    protected $fillable = ['id','username','email','password','token','funds','status','is_deleted','created_at','updated_at'];
    protected $hidden = ['password','token'];
}