<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'product_orders';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'single_price'];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
