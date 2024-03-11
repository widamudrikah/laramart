<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request) {
        $validateData = $request->validated();

        $category = new Category;
        $category->name = $validateData['name'];
        $category->slug = Str::slug($validateData['slug']);
        $category->description = $validateData['description'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;

            $file->move('upload/category', $fileName);
            $category->image = $fileName;
        }
        
        
        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];

        $category->status = $request->status == true ? '1':'0';
        $category->save();

        return redirect()->route('category-index')->with('message', 'Category Added Successfully');
    }


    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, $id) {
        $validateData = $request->validated();
        $category =Category::findOrFail($id);

        $category->name = $validateData['name'];
        $category->slug = Str::slug($validateData['slug']);
        $category->description = $validateData['description'];

        // menghapus image

        if($request->hasFile('image')){

            $path = 'upload/category/'.$category->image;
            if(File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext  = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;

            $file->move('upload/category', $fileName);
            $category->image = $fileName;
        }
        
        
        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];

        $category->status = $request->status == true ? '1':'0';
        $category->update();

        return redirect()->route('category-index')->with('message', 'Category Updated Successfully');

    }


    
    
}
