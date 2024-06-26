<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', '0')->get();
        $trendingProduct = Product::where('trending', '1')->latest()->take(15)->get();
        $newArrivalsProducts = Product::latest()->take(16)->get();

        return view('frontend.index', compact('sliders', 'trendingProduct', 'newArrivalsProducts'));
    }

    public function categories() {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug){
        $category = Category::where('slug', $category_slug)->first();
        if($category) {
            return view('frontend.collections.products.index', compact('category'));

        }else{
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug) {
        $category = Category::where('slug', $category_slug)->first();

        if($category) {
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if($product)
            {
                return view('frontend.collections.products.detail', compact('category', 'product'));
            }
            else
            {
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }

    public function thankYou() {
        return view('frontend.thank-you');
    }

    public function newArrivals() {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('newArrivalsProducts'));
    }

    
}
