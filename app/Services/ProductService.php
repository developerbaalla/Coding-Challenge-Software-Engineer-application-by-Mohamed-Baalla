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


    /**
     * Get All Products.
     *
     * @param  Product  $data
     * @return array
     */
	public function getAll(array $data = [])
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


    /**
     * Save a newly created resource in storage.
     *
     * @param  Product  $data
     * @return bool
     */
	public function saveProduct(array $data = [])
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


    /**
     * Update Product.
     *
     * @param  Product  $id
     * @param  Product  $data
     * @return bool
     */
	public function updateProduct(int $id, array $data = [])
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


    /**
     * Get List Products.
     *
     * @return array
     */
	public function getList()
	{
		return $this->productRepository->list();
	}


    /**
     * find By Id Product.
     *
     * @param  Product  $id
     * @return array
     */
	public function findById($id)
	{
		return $this->productRepository->findById($id);
	}


    /**
     * delete By Id Product.
     *
     * @param  Product  $id
     * @return bool
     */
	public function delete($id)
	{
		return $this->productRepository->delete($id);
	}


    /**
     * Save Files related with Product.
     *
     * @param  Product  $file
     * @return string
     */
    public function imageUpload($file)
    {

        $imageName = time().'.'.$file->extension();
        $file->move(public_path('images'), $imageName);

        return $imageName;
    }


    /**
     * rules to validate product.
     *
     * @return array
     */
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