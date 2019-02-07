<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

  public function province()
  {
    return $this->belongsTo('App\Provinces');
  }

  public function city()
  {
    return $this->belongsTo('App\City');
  }

}
