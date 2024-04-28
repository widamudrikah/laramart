<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    // for pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // brand_id ditambahkan ketika proses update
    public $name, $slug, $status, $brand_id;

    public function rules() {
        return [
            'name'  => 'required|string',
            'slug'  => 'required|string',
            'status'  => 'nullable',
        ];
    }

    // reset form
    public function resetInput(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL; //ini ditambahkan krtika proses delete data
    }

    public function storeBrand() {
        $validatedData = $this->validate();
        Brand::create([
            'name'  =>$this->name,
            'slug'  =>Str::slug($this->slug),
            'status'  =>$this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand Added Successfully');
        // untuk meghilangkan modal setelah dipencet
        $this->dispatch('close-modal');
        $this->resetInput();
    }

// ini untuk edit edit data
    public function closeModal() {
        $this->resetInput();
    }
    public function openModal() {
        $this->resetInput();
    }

// menampilkan si modal dan mendapatkan data
    public function editBrand($brand_id) {

        $this->brand_id = $brand_id;
        // untuk mendapatkan daya yang adan diedit
        $brand = Brand::findOrFail($brand_id);
        $this->name =   $brand->name;
        $this->slug =   $brand->slug;
        $this->status =   $brand->status;
    }

    // ini proses updatenya
    public function updateBrand() {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'  =>$this->name,
            'slug'  =>Str::slug($this->slug),
            'status'  =>$this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand deleted Successfully');
        $this->dispatch('close-modal'); // untuk meghilangkan modal setelah dipencet
        $this->resetInput();
    }

    // delete
    public function deleteBrand($brand_id) {
        $this->brand_id = $brand_id;
    }

    // destroy
    public function destroyBrand() {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatch('close-modal');  // untuk meghilangkan modal setelah dipencet
        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands])
                    ->extends('layouts.admin')
                    ->section('content');

        // ini sebelum menampilkan data, pake yang ini dulu
        // return view('livewire.admin.brand.index')
        //             ->extends('layouts.admin')
        //             ->section('content');
    }
}
