<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'customer_id', 'order_id', 'category_id', 'service_id', 'price', 'profit', 'total_price', 'status', 'order_number', 'tweet_link', 'quantity', 'speed', 'quality', 'custom_comment', 'twitter_space_link', 'current_space_listeners', 'discord_invite_link', 'profile_url', 'time_quantity', 'discord_channel_name', 'created_at', 'updated_at'];
    
    public function customer_info()
    {
        return $this->belongsTo('\App\Customer','customer_id');
    }
    
    public function service_info()
    {
        return $this->belongsTo('\App\Service','service_id');
    }
    
    public function category_info()
    {
        return $this->belongsTo('\App\Category','category_id');
    }
}