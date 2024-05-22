@extends('layouts.app')

@section('title', 'Thank You')
@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-auto mb-auto">
                <img src="{{asset('assets/image/thankyou.gif')}}" alt="thankyou" style="width: 300px; height:300px">
                <h4 class="mt-4">Terimakasih sudah berbelanjaa</h4>
                <a href="{{ route('categories') }}" class="btn btn-primary">Shop Now</a>
            </div>
        </div>
    </div>
</div>

@endsection