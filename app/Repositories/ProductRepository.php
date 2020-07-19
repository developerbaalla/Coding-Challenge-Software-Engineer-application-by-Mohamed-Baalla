<?php

namespace App\Repositories;

use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
	public function all()
	{
		$sortby = !empty(request()->input('sort'))? request()->input('sort'): 'created_at';
		$sorttype = !empty(request()->input('sort'))? 'asc': 'desc';

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

	public function findByCategory($category)
	{
		$sortby = !empty(request()->input('sort'))? request()->input('sort'): 'created_at';
		$sorttype = !empty(request()->input('sort'))? 'asc': 'desc';

		return Product::with('categories')
			->orderBy($sortby, $sorttype)
		    ->whereHas('categories', function($q) use ($category) {
		        $q->where('category_id', $category);
		    })->get();
	}

	public function create($imageName)
	{
        $product = new Product;

        $product->name = request()->input('name');
        $product->description = request()->input('description');
        $product->price = request()->input('price');
        $product->image = $imageName;

        $product->save();

    	// attach categories
    	$product->categories()->attach(request()->input('category_id'));

	}

	public function update($id)
	{
		$product = Product::where('id', $id)->firstOrFail();
		$product->update(request()->only('name', 'price', 'description'));
	}

	public function delete($id)
	{
		Product::where('id', $id)->delete();
	}
}