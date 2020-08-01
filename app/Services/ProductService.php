<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Validator;
use Exception;
use InvalidArgumentException;


class ProductService 
{
	/**
	 * @var $productRepository
	 */
	protected $productRepository;


	/**
	 * ProductService constructor
	 *
	 * @param ProductRepository $productRepository
	 */
	public function __construct(ProductRepository $productRepository)
	{
		$this->productRepository = $productRepository;
	}


	public function getAll($data)
	{
		$sortby = !empty( $data['sort'] )? $data['sort']: 'created_at';

        if ( !empty( $data['category'] ) ) {
            $products = $this->productRepository->findByCategory( 
            	$data['category'], 
            	$sortby 
            );
        }else{
            $products = $this->productRepository->all( 
            	$sortby 
            );
        }

		return $products;
	}


	public function saveProduct($data)
	{

		$validator = Validator::make($data, $this->rules());
        
		if ($validator->fails()) { 
			throw new InvalidArgumentException($validator->errors()->first());
		}

        // create image
		if ( !empty($data['image']) && is_file($data['image']) ) {
			$data['image'] = $this->imageUpload($data['image']);
		}

		$result = $this->productRepository->save($data);

		return $result;
	}


	public function updateProduct($id, $data)
	{

		$validator = Validator::make($data, $this->rules());
        
		if ($validator->fails()) { 
			throw new InvalidArgumentException($validator->errors()->first());
		}

        // create image
		if ( !empty($data['image']) && is_file($data['image']) ) {
			$data['image'] = $this->imageUpload($data['image']);
		}

		$result = $this->productRepository->update($id, $data);

		return $result;
	}


	public function getList()
	{
		return $this->productRepository->list();
	}


	public function findById($id)
	{
		return $this->productRepository->findById($id);
	}


	public function delete($id)
	{
		return $this->productRepository->delete($id);
	}


    public function imageUpload($file)
    {

        $imageName = time().'.'.$file->extension();
        $file->move(public_path('images'), $imageName);

        return $imageName;
    }


    public function rules()
    {
        return [
            // required
            'name' => 'required',
            'description' => 'required|max:212',
            
            // Validate that a provided integer equals 10...
            'price' => 'required|numeric',

            // Validate that an uploaded file is exactly 512 kilobytes...
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}