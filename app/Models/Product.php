<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'feet_id', 'price', 'thumbnail', 'images', 'body_color', 'pancha_saree_color', 'type_id', 'created_by', 'model', 'count', 'status',
    ];
}
