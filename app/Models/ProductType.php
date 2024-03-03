<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class ProductType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'type_id');
    }

    public function productList()
    {
        return $this->hasMany(Product::class,'type_id','id');
    }
}
