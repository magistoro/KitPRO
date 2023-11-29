<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.type.index', ['types' => DB::table('types')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = collect();         

        Category::chunk(200, function ($records) use (&$categories) {
            $categories = $categories->concat($records);
        });

        $categories = Category::whereIsLeaf()->get();
        // dd($categories);

        return view('admin.category.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Product $product)
    {
        $breadcrumbs = Category::ancestorsAndSelf($category->id)->toArray();
        return view('product.show', ['category' => $category, 'product' => $product, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
