@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if(session('message'))
        <h2 class="alert alert-success">{{session('message')}}</h2>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Dashboard</h2>
            <p class="mb-md-0">Your analytics dashboard template.</p>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3 rounded">
                    <label>Total Order</label>
                    <h1>{{ $totalOrder }}</h1>
                    <a href="{{ route('orders-index-admin') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3 rounded">
                    <label>Today Order</label>
                    <h1>{{ $todayOrder }}</h1>
                    <a href="{{ route('orders-index-admin') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3 rounded">
                    <label>This Month Order</label>
                    <h1>{{ $thisMonthOrder }}</h1>
                    <a href="{{ route('orders-index-admin') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3 rounded">
                    <label>This Year Order</label>
                    <h1>{{ $thisYearOrder }}</h1>
                    <a href="{{ route('orders-index-admin') }}" class="text-white">View</a>
                </div>
            </div>
        </div>
        

        <h2 class="mt-3">Items</h2>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3 rounded">
                    <label>Total Product</label>
                    <h1>{{ $totalProduct }}</h1>
                    <a href="{{ route('product-index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3 rounded">
                    <label>Total Categories</label>
                    <h1>{{ $totalCategories }}</h1>
                    <a href="{{ route('category-index') }}" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3 rounded">
                    <label>Total Brands</label>
                    <h1>{{ $totalBrands }}</h1>
                    <a href="{{ route('brands') }}" class="text-white">View</a>
                </div>
            </div>
            
        </div>


        <h2 class="mt-3">Users</h2>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3 rounded">
                    <label>All Users</label>
                    <h1>{{ $totalAllUser }}</h1>
                    <a href="#" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3 rounded">
                    <label>Total Admin</label>
                    <h1>{{ $totalAdmin }}</h1>
                    <a href="#" class="text-white">View</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3 rounded">
                    <label>Total User</label>
                    <h1>{{ $totalUser }}</h1>
                    <a href="#" class="text-white">View</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection