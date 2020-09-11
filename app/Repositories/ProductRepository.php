<?php

namespace App\Repositories;

use App\Product;

class ProductRepository 
{

    /**
     * Get All Products.
     *
     * @param  Product  $sortby
     * @param  Product  $sorttype
     * @return array
     */
	public function all(string $sortby = 'created_at', string $sorttype = 'desc')
	{

		return Product::with('categories')
			->orderBy($sortby, $sorttype)
			->get();
	}

    /**
     * find By Id Product.
     *
     * @param  Product  $id
     * @return array
     */
	public function findById(int $id)
	{

		return Product::where('id', $id)
		->with('categories')
		->first();
	}

    /**
     * find By Category Product.
     *
     * @param  Product  $categoryId
     * @param  Product  $sortby
     * @param  Product  $sorttype
     * @return array
     */
	public function findByCategory(int $categoryId, string $sortby = 'created_at', string $sorttype = 'desc')
	{

		return Product::with('categories')
			->orderBy($sortby, $sorttype)
		    ->whereHas('categories', function($q) use ($categoryId) {
		        $q->where('category_id', $categoryId);
		    })->get();
	}

    /**
     * Save a newly created resource in storage.
     *
     * @param  Product  $data
     * @return bool
     */
	public function save(array $data)
	{

        $res = Product::insert([
			Product::NAME => $data['name'],
        	Product::DESCRIPTION => $data['description'],
        	Product::PRICE => $data['price'],
        	Product::IMAGE => $data['image'],
		]);

    	// attach categories
    	$product->categories()->attach( $data['category_id'] );

		return $res;
	}

    /**
     * Update Product.
     *
     * @param  Product  $id
     * @param  Product  $data
     * @return bool
     */
	public function update(int $id, array $data)
	{

		$product = Product::where('id', $id)->firstOrFail();
		return $product->update($data);
	}

    /**
     * Delete Product.
     *
     * @param  Product  $id
     * @return bool
     */
	public function delete(int $id)
	{

		return Product::where('id', $id)->delete();
	}
}