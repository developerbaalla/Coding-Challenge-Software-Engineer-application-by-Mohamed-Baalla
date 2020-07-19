<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     *
     * @var App\Repositories\ProductRepositoryInterface
     */
    private $productRepository;


    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CategoryRepositoryInterface $categories)
    {

        if ($request->input('category')) {
            $products = $this->productRepository->findByCategory( $request->input('category') );
        }else{
            $products = $this->productRepository->all();
        }

        $categories = $categories->list();
        return view('product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepositoryInterface $categories)
    {
        $categories = $categories->list();
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
        $this->validate($request, [
            // required
            'name' => 'required',
            'description' => 'required|max:212',
            
            // Validate that a provided integer equals 10...
            'price' => 'required|numeric',

            // Validate that an uploaded file is exactly 512 kilobytes...
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // creat product function needs imageName
        $this->productRepository->create( $this->imageUpload($request->file('image')) );

        return redirect('product')->with('success', 'It is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findById($id);
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
        $product = $this->productRepository->findById($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // required
            'name' => 'required',
            'description' => 'required|max:212',
            
            // Validate that a provided integer equals 10...
            'price' => 'required|numeric',

            // Validate that an uploaded file is exactly 512 kilobytes...
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = $this->productRepository->update($id);
        return redirect('product')->with('success', 'It is done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect('/product/')->with('success', 'It is done');
    }


    public function imageUpload($file)
    {

        $imageName = time().'.'.$file->extension();
        $file->move(public_path('images'), $imageName);

        return $imageName;
    }
}
