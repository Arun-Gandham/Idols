<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\OrderTimeline;
use App\Models\User;
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'name', 'address', 'phone1', 'phone2', 'price', 'advance', 'cover_price', 'crane_price', 'note', 'model','status_id','created_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderTimeline()
    {
        return $this->hasMany(OrderTimeline::class,'order_id');
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class,'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
