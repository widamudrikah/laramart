@extends('layouts.admin')

@section('content')


<div class="row">
    <div class="col-md-12 grid-margin">

        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Edit Slider
                    <a href="{{ route('slider-index')}}" class="btn btn-danger btn-sm text-white float-end">
                        Back
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('slider-update', $slider->id )}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" value="{{$slider->title}}" name="title" class="form-control">
                        @error('title') <small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control">{{$slider->description}}</textarea>
                        @error('description') <small class="text-danger">{{$message}}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image') <small class="text-danger">{{$message}}</small> @enderror
                        <img src="{{ asset("$slider->image") }}" alt="Slider" style="width: 50px; height: 50px">
                    </div>

                    <div class="mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked': '' }}> Checked = Hidden, unchecked = Visible
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection