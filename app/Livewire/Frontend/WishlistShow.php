<?php

namespace App\Livewire\Frontend;

use App\Models\Whislist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem($wishlistId){
        // dd($wishlistId);
        $user_id = Auth::user()->id;
        Whislist::where('user_id', $user_id)->where('id', $wishlistId)->delete();
        // $this->emit('wishlistAddedUpdated');
        $this->dispatch('wishlistAddedUpdated'); 

        session()->flash('message', 'berhasil dihapus');
    }
    public function render()
    {
        $user_id = Auth::user()->id;
        $wishlist = Whislist::where('user_id', $user_id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}
