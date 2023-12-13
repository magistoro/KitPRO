<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Kalnoy\Nestedset\Node;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    //  ДЛЯ РАБОТЫ С БЛЕЙДАМИ
    public function index(Category $category)
    {
        $children = $category->children->toArray();
        $breadcrumbs = Category::ancestorsAndSelf($category->id)->toArray();
        // dd($breadcrumbs);
        // dd($children);
        if (!empty($children)){
            return view('category.index', ['category' => $category, 'children' => $children, 'breadcrumbs' => $breadcrumbs]);
        }
        $products = $category->products()->with('type')->get();
        return view('product.index', ['category' => $category, 'products' => $products, 'breadcrumbs' => $breadcrumbs]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
