<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
	public function all()
	{
		return Category::all()
			->orderBy('name', 'asc')
			->get();
	}

	public function list()
	{
		return Category::all()->pluck('name', 'id');
	}

	public function categoriesWithChildren()
	{
		return Category::with('childrenRecursive')
			->whereNull('parent_category')
			->orderBy('name', 'asc')
			->get();
	}

	public function create()
	{
        $category = new Category;

        $category->name = request()->input('name');
        $category->parent_category = request()->input('parent_category');

        $category->save();
	}

	public function delete($id)
	{
		Category::where('id', $id)->delete();
	}
}