<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\OrderStatus;
class OrderTimeline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','status_id','description','amount','is_deleted','created_id','deleted_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function timelineStatus()
    {
        return $this->hasOne(OrderStatus::class,'id','status_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_id');
    }

    public function deletedBy()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
