<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;


    // ini untuk hapus
    public function deleteCategory($category_id) {
        // dd($category_id);
        $this->category_id = $category_id;
    }

    // unyuk hapus juga
    public function destroyCategory() {
        $category = Category::find($this->category_id);
        // dd($category);
        $path = 'upload/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        
        $category->delete();
        session()->flash('message', 'Category Deleted');
    }


    // public function destroyCategory() {
    //     try {
    //         $category = Category::find($this->category_id);
    
    //         if ($category) {
    //             $path = 'upload/category/' . $category->image;
    
    //             if (File::exists($path)) {
    //                 File::delete($path);
    //             }
    
    //             $category->delete();
    //             session()->flash('message', 'Category Deleted');
    //         } else {
    //             session()->flash('error', 'Category not found');
    //         }
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Error deleting category: ' . $e->getMessage());
    //     }
    // }
    

    public function render()
    {
        $category = Category::orderBy('id', 'DESC')->paginate(10);   //ini untuk yang digeser-geser
        return view('livewire.admin.category.index', ['categories' => $category]);
    }
}
