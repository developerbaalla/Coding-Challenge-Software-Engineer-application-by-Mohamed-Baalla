<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     *
     * @var App\Repositories\CategoryRepositoryInterface
     */
    private $categoryRepository;


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->categoriesWithChildren();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->list();
        return view('category.create', compact('categories'));
    }

    /**
     * Create a new form instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $categories = $this->categoryRepository->create();
        return redirect('category')->with('success', 'It is created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect('category');
    }
}
