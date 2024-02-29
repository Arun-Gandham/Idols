<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ProductFeet;
use App\Models\ProductType;
use App\Models\User;
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'feet_id', 'price', 'thumbnail', 'images', 'body_color', 'pancha_saree_color', 'type_id', 'created_by', 'model', 'stock', 'status','is_deleted'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function feet()
    {
        return $this->hasOne(ProductFeet::class,'id');
    }

    public function type()
    {
        return $this->hasOne(ProductType::class,'id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class,'id');
    }


}
