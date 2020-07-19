<?php

namespace App\Repositories;


interface ProductRepositoryInterface
{
	public function all();

	public function findById($id);
	
	public function findByCategory($category);
	
	public function create($imageName);

	public function update($id);

	public function delete($id);
}