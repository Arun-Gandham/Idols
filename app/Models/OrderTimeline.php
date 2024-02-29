<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\OrderStatus;
class OrderTimeline extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class,'id');
    }
}
