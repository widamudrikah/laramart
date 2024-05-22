@extends('layouts.admin')

@section('title', 'Order Details')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">

        @if(session('message'))
            <div class="alert alert-success mb-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Detail Orders</h3>
            </div>
            <div class="card-body">
                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark"></i> Order Detail
                    <a href="{{ route('orders') }}" class="btn btn-danger btn-sm float-end mx-1">Back</a>
                    <a href="{{ route('generate-invoice', $order->id) }}" class="btn btn-primary btn-sm float-end mx-1">
                        Dowload Invoice
                    </a>
                    <a href="{{ route('view-invoice', $order->id) }}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">
                        View Invoice
                    </a>
                </h4>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h6>Order Id : {{ $order->id }}</h6>
                        <h6>Tracking ID/No. : {{ $order->tracking_no }}</h6>
                        <h6>Order Created Date : {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                        <h6>Payment Mode : {{ $order->payment_mode }}</h6>
                        <h6 class="border p-2 text-success">
                            Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>Username Details</h5>
                        <hr>
                        <h6>Full Name : {{ $order->fullname }}</h6>
                        <h6>Email : {{ $order->email }}</h6>
                        <h6>Phone : {{ $order->phone }}</h6>
                        <h6>Address : {{ $order->address }}</h6>
                        <h6>Pin Code : {{ $order->pincode }}</h6>
                    </div>
                </div>

                <br>
                <h5>Order Items</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $totalPrice = 0;
                            @endphp

                            @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td width="10%">{{ $orderItem->id }}</td>
                                <td width="10%">
                                    @if($orderItem->product->productImages)
                                    <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $orderItem->product->name }}">
                                    @else
                                    <img src="" style="width: 50px; height: 50px" alt="image">
                                    @endif
                                </td>
                                <td>
                                    {{ $orderItem->product->name }}
                                    @if ($orderItem->productColor)
                                    @if($orderItem->productColor->color)
                                    <span>- Color : {{ $orderItem->productColor->color->name }}</span>
                                    @endif
                                    @endif
                                </td>
                                <td width="10%">@rupiah($orderItem->price)</td>
                                <td width="10%">{{ $orderItem->quantity }}</td>
                                <td width="20%" class="fw-bold">@rupiah($orderItem->quantity * $orderItem->price)</td>
                                @php
                                $totalPrice += $orderItem->quantity * $orderItem->price;
                                @endphp
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="fw-bold">Total Amount</td>
                                <td colspan="1" class="fw-bold">@rupiah($totalPrice)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="card border mt-3">
            <div class="card-body">
                <h4 >Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{ route('orders-update-status', $order->id ) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Update Order Status</label>
                            <div class="input-group mt-2">
                                <select name="order_status" class="form-select">
                                    <option value="">Select Status</option>
                                    <option value="in progress" {{ Request::get('status') == 'in progress' ? 'selected':'' }}>in progress</option>
                                    <option value="completed" {{ Request::get('status') == 'completed' ? 'selected':'' }}>Completed</option>
                                    <option value="pending" {{ Request::get('status') == 'pending' ? 'selected':'' }}>Pending</option>
                                    <option value="canceled" {{ Request::get('status') == 'canceled' ? 'selected':'' }}>Canceled</option>
                                    <option value="out-for-delivery" {{ Request::get('status') == 'out-for-delivery' ? 'selected':'' }}>Out For Delivery</option>
                                </select>

                                <button type="submit" class="btn btn-primary text-white">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3">Current Order Status: <span class="text-uppercase">{{ $order->status_message }}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection