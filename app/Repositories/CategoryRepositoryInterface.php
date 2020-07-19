<?php

namespace App\Repositories;


interface CategoryRepositoryInterface
{
	public function all();

	public function list();
	
	public function categoriesWithChildren();

	public function create();

	public function delete($id);
}