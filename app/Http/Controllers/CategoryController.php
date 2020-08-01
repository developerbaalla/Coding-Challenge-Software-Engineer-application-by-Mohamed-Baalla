<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     *
     * @var App\Services\CategoryService
     */
    private $categoryService;


    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryService->getCategoriesWithChildren();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getList();
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

        $data = $request->only([
            'name',
            'parent_category'
        ]);

        try { 
            $result['data'] = $this->categoryService->saveCategory($data);
            $result = [
                'status' => 'success',
                'msg' => 'It is created'
            ];
        } 
        catch (Exception $e) { 
            $result = [
                'status' => 'error', 
                'msg' => $e->getMessage()
            ];
        } 

        return redirect('category')->with($result['status'], $result['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect('category');
    }
}
