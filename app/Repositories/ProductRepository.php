<?php

namespace App\Repositories;

use App\Product;

class ProductRepository 
{
	public function all($sortby = 'created_at', $sorttype = 'desc')
	{

		return Product::with('categories')
			->orderBy($sortby, $sorttype)
			->get();
	}

	public function findById($id)
	{

		return Product::where('id', $id)
		->with('categories')
		->first();
	}

	public function findByCategory($category, $sortby = 'created_at', $sorttype = 'desc')
	{

		return Product::with('categories')
			->orderBy($sortby, $sorttype)
		    ->whereHas('categories', function($q) use ($category) {
		        $q->where('category_id', $category);
		    })->get();
	}

	public function save($data)
	{
        $product = new Product;

        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->image = $data['image'];

        $product->save();

    	// attach categories
    	$product->categories()->attach( $data['category_id'] );

	}

	public function update($id, $data)
	{
		$product = Product::where('id', $id)->firstOrFail();
		$product->update($data);
	}

	public function delete($id)
	{
		return Product::where('id', $id)->delete();
	}
}