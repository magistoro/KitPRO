<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
       return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.category.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        // Generating a new file name as file extension concatenated to current time (for uniqueness) 
        $fileName = time() . '.' . $data['thumbnail']->getClientOriginalExtension();
        // moving file to public/images directory with new name
        $data['thumbnail']->move(public_path('Content/Category/thumbnails'), $fileName);



        $category = new Category($data);
        $parent = Category::find($data['parent_id']);

        $category->thumbnail = $fileName;
        $parent->children()->save($category); 

       
        return redirect()->route('admin.category.index')->with('success', 'Категория '.$category['name'].' успешно добавлена!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
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
         if (isset($data['parent_id'])) {
            // Если есть, найдем родительскую категорию
            $parent = Category::find($data['parent_id']);
            // Обновим родительскую связь
            $category->parent()->associate($parent);
        }
        // dd($data);
         // Обновление данных продукта
         $category->update($data);
 
         return redirect()->route('admin.category.show', $category->id)->with('success', 'Категория '.$category['name'].' успешно обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success',  'Категория '.$category['name'].' успешно удалена!');
    }
}
