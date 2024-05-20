<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;

    public function removeCartItem(int $cartId) {
        $cartRemoveData = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if($cartRemoveData) {
            $cartRemoveData->delete();

            $this->dispatch('cartAddedUpdated');
            session()->flash('message', 'berhasil dihapus');
            return false;
        }else{
            session()->flash('message', 'Gak ditemuin barangnya bang');
            return false;
        }
    }


    public function decrementQuantity($cartId) {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {

                $productColor = $cartData->productColor->where('id', $cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity) {

                    $cartData->decrement('quantity');
                    session()->flash('message', 'Quantity has been updated');
                    return false;
                }else {
                    session()->flash('message', 'hanya ' .$cartData->quantity. 'yang tersedia');
                    return false;
                }
            }else{

                if($cartData->product->quantity > $cartData->quantity)
                {
                    $cartData->decrement('quantity');
                    session()->flash('message', 'Quantity has been updated');
                    return false;
                }else {
                    session()->flash('message', 'hanya ' .$cartData->product->quantity. 'yang tersedia');
                    return false;
                }
            }
   
        }else{
            session()->flash('message', 'Berhasil ditambahkan ke cartada yang salah bang');
            return false;
        }
    }

    public function incrementQuantity($cartId) {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cartData)
        {
            if($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {

                $productColor = $cartData->productColor->where('id', $cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity) {

                    $cartData->increment('quantity');
                    session()->flash('message', 'Quantity has been updated');
                    return false;
                }else {
                    session()->flash('message', 'hanya ' .$cartData->quantity. 'yang tersedia');
                    return false;
                }
            }else{
                if($cartData->product->quantity > $cartData->quantity)
                {
                    $cartData->increment('quantity');
                    session()->flash('message', 'Quantity has been updated');
                    return false;
                }else {
                    session()->flash('message', 'hanya ' .$cartData->product->quantity. 'yang tersedia');
                    return false;
                }
            }
   
        }else{
            session()->flash('message', 'Berhasil ditambahkan ke cartada yang salah bang');
            return false;
        }
    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
