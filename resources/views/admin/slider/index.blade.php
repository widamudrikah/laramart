@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-md-12 grid-margin">

        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Slider List
                    <a href="{{ route('slider-create')}}" class="btn btn-primary btn-sm text-white float-end">
                        Add List
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->description}}</td>
                                <td>
                                    <img src="{{ asset("$slider->image") }}" style="width: 70px; height: 30px" alt="img">
                                </td>
                                <td>{{$slider->status == '0' ? 'Visible' : 'Hidden'}}</td>
                                <td>
                                    <a href="{{ route('slider-edit', $slider->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('slider-delete', $slider->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this?')"
                                    >Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection