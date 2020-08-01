<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use InvalidArgumentException;

class ProductController extends Controller
{

    /**
     *
     * @var App\Services\ProductService
     */
    private $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryService $categoryService)
    {

        $data = $request->only([
            'sort',
            'category'
        ]);

        $products = $this->productService->getAll( $data );

        $categories = $categoryService->getList();

        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryService $categoryService)
    {
        $categories = $categoryService->getList();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->only([
            'name',
            'description', 
            'price', 
            'image', 
            'category_id', 
        ]);

        try { 
            $result['data'] = $this->productService->saveProduct($data);
            $result = [
                'redirect' => 'product', 
                'status' => 'success',
                'msg' => 'It is created'
            ];
        } 
        catch (Exception $e) { 
            $result = [
                'redirect' => 'product.create', 
                'status' => 'error', 
                'msg' => $e->getMessage()
            ];
        } 

        return redirect()->route($result['redirect'])->with($result['status'], $result['msg']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->findById($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productService->findById($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $data = $request->only([
            'name',
            'description', 
            'price', 
            'image', 
            'category_id', 
        ]);

        try { 
            $result['data'] = $this->productService->updateProduct($id, $data);
            $result = [
                'redirect' => 'product', 
                'status' => 'success',
                'msg' => 'It is created'
            ];
        } 
        catch (Exception $e) { 
            $result = [
                'redirect' => 'product.edit', 
                'status' => 'error', 
                'msg' => $e->getMessage()
            ];
        } 

        return redirect()->route($result['redirect'], $id)->with($result['status'], $result['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect('product')->with('success', 'It is done');
    }

}
