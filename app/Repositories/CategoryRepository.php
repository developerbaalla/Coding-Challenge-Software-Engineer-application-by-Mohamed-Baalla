<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository
{
	/**
	 * @var $category
	 */
	protected $category;


	/**
	 * CategoryRepository constructor
	 *
	 * @param Category $category
	 */
	public function __construct(Category $category)
	{
		$this->category = $category;
	}


	public function save($data)
	{

        $category = new $this->category;

        $category->name = $data['name'];
        $category->parent_category = $data['parent_category'];

        $category->save();

        return $category->fresh();
	}

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
			// ->whereNull('parent_category')
			->orderBy('name', 'asc')
			->get(); 
	}

	public function delete($id)
	{
		Category::where('id', $id)->delete();
	}
}