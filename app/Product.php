<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = [];


	const NAME = 'name';
	const DESCRIPTION = 'description';
	const PRICE = 'price';
	const IMAGE = 'image';
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    /**
     * The categories that belong to the products.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
