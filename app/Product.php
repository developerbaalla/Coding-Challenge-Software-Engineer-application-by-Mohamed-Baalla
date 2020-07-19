<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [];

    /**
     * The categories that belong to the products.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
