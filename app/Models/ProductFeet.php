<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class ProductFeet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'feet'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'feet_id');
    }
}
