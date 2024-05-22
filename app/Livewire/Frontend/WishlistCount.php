<?php

namespace App\Livewire\Frontend;

use App\Models\Whislist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;

    // wishlistAddedUpdated
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];

    public function checkWishlistCount() {
       if(Auth::check()) {
            return $this->wishlistCount = Whislist::where('user_id', auth()->user()->id)->count();
       }else {
            
        return $this->wishlistCount = 0;
       }
    }
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
