<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    // SETELAH SELESAI SETUP DISINI TINGGAL BUAT MIGRASI
    // for pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // brand_id ditambahkan ketika proses update, tambahkan category id untuk update
    public $name, $slug, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'name'  => 'required|string',
            'slug'  => 'required|string',
            'category_id'  => 'required|integer',
            'status'  => 'nullable',
        ];
    }

    // reset form
    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL; //ini ditambahkan krtika proses delete data
        $this->category_id = NULL; //ini ditambahakan ketika nambahin category yaa
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name'  => $this->name,
            'slug'  => Str::slug($this->slug),
            'status'  => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);
        session()->flash('message', 'Brand Added Successfully');
        // untuk meghilangkan modal setelah dipencet
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    // ini untuk edit edit data
    public function closeModal()
    {
        $this->resetInput();
    }
    public function openModal()
    {
        $this->resetInput();
    }

    // menampilkan si modal dan mendapatkan data
    public function editBrand($brand_id)
    {

        $this->brand_id = $brand_id;
        // untuk mendapatkan daya yang adan diedit
        $brand = Brand::findOrFail($brand_id);
        $this->name =   $brand->name;
        $this->slug =   $brand->slug;
        $this->status =   $brand->status;
        $this->category_id =   $brand->category_id;
    }

    // ini proses updatenya
    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'  => $this->name,
            'slug'  => Str::slug($this->slug),
            'status'  => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);
        session()->flash('message', 'Brand deleted Successfully');
        $this->dispatch('close-modal'); // untuk meghilangkan modal setelah dipencet
        $this->resetInput();
    }

    // delete
    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    // destroy
    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatch('close-modal');  // untuk meghilangkan modal setelah dipencet
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');

        // ini sebelum menampilkan data, pake yang ini dulu
        // return view('livewire.admin.brand.index')
        //             ->extends('layouts.admin')
        //             ->section('content');
    }
}
