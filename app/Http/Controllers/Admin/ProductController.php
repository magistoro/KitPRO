<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;


use App\Models\Category;
use App\Models\Type;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.product.index', compact('products', 'categories'));
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

        $types = Type::all();
        // dd($categories);

        return view('admin.product.create', ['categories' => $categories, 'types' =>  $types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        // // Generating a new file name as file extension concatenated to current time (for uniqueness) 
        $fileName = time() . '.' . $data['thumbnail']->getClientOriginalExtension();
        // // moving file to public/images directory with new name
        $data['thumbnail']->move(public_path('Content/Product/thumbnails'), $fileName);



        $product = new Product($data);
        $product->save();
        $product -> thumbnail = $fileName;
        $product -> update();
     
        // Product::firstOrCreate([
        //     'name' => $data['name'],
            
        // ], $data); 
       
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Product $product)
    {
        // $breadcrumbs = Category::ancestorsAndSelf($category->id)->toArray();
        // return view('product.show', ['category' => $category, 'product' => $product, 'breadcrumbs' => $breadcrumbs]);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = collect();         

        Category::chunk(200, function ($records) use (&$categories) {
            $categories = $categories->concat($records);
        });

        $categories = Category::whereIsLeaf()->get();

        $types = Type::all();

        return view('admin.product.edit', compact('product', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
          // Получаем валидированные данные из формы
          $data = $request->validated(); 
 
          // Удаление прошлой картинки и добавление новой
         //  if ($data['preview_image'] ?? null) {
         //      Storage::disk('public')->delete('/images/'.$product->preview_image); // удаление
              
         //      $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']); // добавление
         //  }
         //  else{
         //      $data['preview_image'] = $product->preview_image; // оставляем существующую картинку
         //  }
  
  
         // Проверяем, есть ли новое значение parent_id в входных данных
        //   if (isset($data['parent_id'])) {
        //      // Если есть, найдем родительскую категорию
        //      $parent = Category::find($data['parent_id']);
        //      // Обновим родительскую связь
        //      $category->parent()->associate($parent);
        //  }
        //  // dd($data);
        //   // Обновление данных продукта
        //   $category->update($data);
  
        //   return redirect()->route('admin.category.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
