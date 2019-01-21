<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use Searchable;

	public $asYouType = true;
  // public $timestamps = false;

	public function toSearchableArray()
  {
    $array = [
    	'id'					=> $this->id,
      'name'        => $this->name,
      'description' => $this->description
	  ];

    return $array;
  }
	
  public function category()
  {
  	return $this->belongsTo('App\ProductCategory');
  }
}
