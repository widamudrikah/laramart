@extends('layouts.app')

@section('title', 'Home Page')
@section('content')

<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
        @foreach($sliders as $key => $sliderItem)
        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
            <img src="{{asset("$sliderItem->image")}}" class="d-block w-100" alt="...">
            <!-- <div class="carousel-caption d-none d-md-block">
                <h5>{{$sliderItem->title}}</h5>
                <p>{{$sliderItem->description}}</p>
            </div> -->

            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1>
                        {{$sliderItem->title}}
                    </h1>
                    <p>
                        {{$sliderItem->description}}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Welcome to LaraMart ✨✨</h4>
                <div class="underline  mx-auto">
                </div>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Deserunt, dolor fugit impedit et doloremque debitis quis
                    consequuntur consectetur minima quaerat id veritatis
                    assumenda dolorem magnam odit explicabo, aperiam temporibus
                    rerum ducimus enim inventore soluta. Harum nemo placeat iusto
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Trending Product</h4>
                <div class="underline mb-4"></div>
            </div>

            @if($trendingProduct)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach($trendingProduct as $product)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-warning">Trending</label>

                                @if($product->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $product->brand}}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                        {{ $product->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">@rupiah($product->selling_price)</span>
                                    <span class="original-price">@rupiah($product->original_price)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No product</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline mb-4"></div>
            </div>

            @if($newArrivalsProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach($newArrivalsProducts as $product)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-danger">New</label>

                                @if($product->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $product->brand}}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                        {{ $product->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">@rupiah($product->selling_price)</span>
                                    <span class="original-price">@rupiah($product->original_price)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No New Arrivals Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


<div class="py-5">
    <div class="container">
        <div class="row">
            @if($trendingProduct)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach($trendingProduct as $product)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-warning">Trending</label>

                                @if($product->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $product->brand}}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                        {{ $product->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">@rupiah($product->selling_price)</span>
                                    <span class="original-price">@rupiah($product->original_price)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No product</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            @if($trendingProduct)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach($trendingProduct as $product)
                    <div class="item">
                        <div class="product-card">
                            <div class="product-card-img">
                                <label class="stock bg-warning">Trending</label>

                                @if($product->productImages->count() > 0)
                                <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{$product->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $product->brand}}</p>
                                <h5 class="product-name">
                                    <a href="{{ url('/collections/'.$product->category->slug.'/'.$product->slug) }}">
                                        {{ $product->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">@rupiah($product->selling_price)</span>
                                    <span class="original-price">@rupiah($product->original_price)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No product</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $('.four-carousel').owlCarousel({
        loop: true,
        margin: 10,
        dots:false,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
</script>

@endsection