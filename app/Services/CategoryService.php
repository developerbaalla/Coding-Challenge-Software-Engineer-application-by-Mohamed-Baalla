<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Exception;
use InvalidArgumentException;


class CategoryService 
{
	/**
	 * @var $categoryRepository
	 */
	protected $categoryRepository;


	/**
	 * CategoryService constructor
	 *
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}


	public function saveCategory($data)
	{
		$validator = Validator::make($data, [
			'name' => 'required', 
			// 'parent_category'=> 'required'
		]);

		if ($validator->fails()) { 
			throw new InvalidArgumentException($validator->errors()->first());
		}

		$result = $this->categoryRepository->save($data);

		return $result;
	}


	public function getList()
	{
		return $this->categoryRepository->list();
	}


	public function getCategoriesWithChildren()
	{
		return $this->categoryRepository->categoriesWithChildren();
	}


	public function delete($id)
	{
		return $this->categoryRepository->delete($id);
	}
}