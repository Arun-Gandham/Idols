<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderTimeline;
class OrderStatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'status_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'status_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderTimeline::class,'status_id');
    }
}
