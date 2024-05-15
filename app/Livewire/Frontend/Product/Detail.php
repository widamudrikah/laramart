<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Whislist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{

    public $category, $product, $prodColorSelectQuantity, $quantityCount = 1;


    public function addToWhistlist($productId)
    {
        // dd($productId);

        if (Auth::check()) {
            // dd('alooo');
            if (Whislist::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Product sudah ada di wishlist');
                return false;
            } else {
                Whislist::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                ]);
                $this->dispatch('wishlistAddedUpdated'); 
                session()->flash('message', 'Ditambahkan ke wishlist');
            }
        } else {
            session()->flash('message', 'Login dulu bang');
            return false;
        }
    }


    public function colorSelected($productColorId)
    {
        // dump($productColorId);
        $productColor =  $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectQuantity = $productColor->quantity;

        if ($this->prodColorSelectQuantity == 0) {
            $this->prodColorSelectQuantity = 'outOfStock';
        }
    }

    public function incrementQuantity() {
        if($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity() {
        if($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function addToCart($product_id) {
        if(Auth::check()) {
            // dd($product_id);
            if($this->product->where('id', $product_id)->where('status', '0')->exists()){
                if($this->product->quantity > 0){
                    if($this->product->quantity > $this->quantityCount){
                        // Insert product to cart


                    }else {
                        session()->flash('message', 'Stok cuma '.$this->product->quantity.'bang');
                        return false;
                    }

                }else{
                    session()->flash('message', 'Barang kosong bang');
                    return false;
                }

            }else {
                session()->flash('message', 'Barang belum launcing bang');
                return false;
            }

        }else{
            session()->flash('message', 'Login dulu bang');
            return false;
        }
    }


    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.detail', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
