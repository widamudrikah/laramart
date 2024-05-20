<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Whislist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Detail extends Component
{

    public $category, $product, $prodColorSelectQuantity, $quantityCount = 1, $productColorId;


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

        $this->productColorId = $productColorId;
        // kode diatas ditambah untuk proses add to cart
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
            if($this->product->where('id', $product_id)->where('status', '0')->exists())
            {
                // check for product color quantity and add to cart
                if($this->product->productColors()->count() > 1)
                { 
                    // dd('am color');
                    if($this->prodColorSelectQuantity != NULL)
                    {
                            // dd('pilih warna ini bg');
                        if(Cart::where('user_id', auth()->user()->id)
                                ->where('product_id', $product_id)
                                ->where('product_color_id', $this->productColorId)
                                ->exists())
                        {
                            session()->flash('message', 'Barang udah dimasukin ke keranjang bang');
                            return false;
                        }
                        else
                        {
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if($productColor->quantity > 0)
                            {
                                if($productColor->quantity > $this->quantityCount)
                                {
                                    // Insert product to cart yang punya warnaaaa. INI COPY DARI YANG GAK PUNYA WARNA YAHH
                                    // dd('add cart pake warna');
                                    Cart::create([
                                        'user_id' => Auth::user()->id,
                                        'product_id' => $product_id,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    // dispacth, ditambah ketika create data udah berhasil
                                    $this->dispatch('cartAddedUpdated');
                                    session()->flash('message', 'Berhasil ditambahkan ke cart');
                                    return false;
        
                                }
                                else
                                {
                                    session()->flash('message', 'Stok cuma '.$this->product->quantity.'bang');
                                    return false;
                                }
                            }else{
                                session()->flash('message', 'Warna yang ini lagi kosong bang');
                                return false;
                            }
                        }
                    }
                    else{
                        session()->flash('message', 'Pilih warna dulu bang');
                        return false;
                    }
                }
                else
                {
                    if(Cart::where('user_id', auth()->user()->id)->where('product_id', $product_id)->exists())
                    {
                        session()->flash('message', 'Barang udah dimasukin ke keranjang bang');
                        return false;
                    }
                    else
                    {
                        if($this->product->quantity > 0)
                        {
                            if($this->product->quantity > $this->quantityCount){
                                // Insert product to cart yang gak punya warnaaaa
                                // dd('add cart ga pake warna');
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $product_id,
                                    'quantity' => $this->quantityCount,
                                ]);
                                // dispacth, ditambah ketika create data udah berhasil
                                $this->dispatch('cartAddedUpdated');
                                session()->flash('message', 'Berhasil ditambahkan ke cart');
                                return false;
    
                            }else {
                                session()->flash('message', 'Stok cuma '.$this->product->quantity.'bang');
                                return false;
                            }
    
                        }
                        else
                        {
                            session()->flash('message', 'Barang kosong bang');
                            return false;
                        }
                    }
                    
            }

            }
            else
            {
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
