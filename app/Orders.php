<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id', 'address_id', 'total_price', 'status'];

    public function productOrder()
    {
      return $this->belongsTo('App\ProductOrder');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function address()
    {
      return $this->belongsTo('App\Address');
    }

    public function payment()
    {
      return $this->belongsTo('App\PaymentOrder');
    }
}
