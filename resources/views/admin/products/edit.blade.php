@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-header">
        <h3>Edit Products
          <a href="{{ route('product-index')}}" class="btn btn-danger btn-sm text-white float-end">
            Back
          </a>
        </h3>
      </div>
      <div class="card-body">
        <!-- ini untuk alert -->
        @if(session('message'))
        <h4 class="alert alert-success">{{session('message')}}</h4>
        @endif

        <form action="{{route('product-update', $product->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                Home
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">
                SEO Tags
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
                Details
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                Product Image
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab">
                Product Color
              </button>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <!-- category field -->
              <div class="mb-3">
                <label>Category</label>
                <select name="category_id" id="" class="form-select">

                  @foreach($categories as $category)
                  <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}}>
                    {{ $category->name }}
                  </option>
                  @endforeach

                </select>
              </div>
              <!-- product name field -->
              <div class="mb-3">
                <label for="">Product Name</label>
                <input type="text" value="{{ $product->name }}" name="name" class="form-control">
              </div>
              <!-- product slug field -->
              <div class="mb-3">
                <label for="">Product Slug</label>
                <input type="text" value="{{ $product->slug }}" name="slug" class="form-control">
              </div>
              <!-- Brand -->
              <div class="mb-3">
                <label>Brand</label>
                <select name="brand" id="" class="form-select">

                  @foreach($brands as $brand)
                  <option value="{{$brand->name}}" {{$brand->name == $product->brand ? 'selected':''}}>
                    {{ $brand->name }}
                  </option>
                  @endforeach

                </select>
              </div>
              <!-- Small desc -->
              <div class="mb-3">
                <label for="">Small Description (500 words)</label>
                <textarea name="small_description" class="form-control" rows="4">
                {{$product->small_description}}
                </textarea>
              </div>
              <!-- Description -->
              <div class="mb-3">
                <label for="">Description</label>
                <textarea name="description" class="form-control" rows="4">
                {{$product->description}}
                </textarea>
              </div>

            </div>
            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag" tabindex="0">
              <!-- Meta title field -->
              <div class="mb-3">
                <label for="">Meta Title</label>
                <input type="text" value="{{ $product->meta_title }}" name="meta_title" class="form-control">
              </div>
              <!-- Meta desc -->
              <div class="mb-3">
                <label for="">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="4">
                {{$product->meta_description}}
                </textarea>
              </div>
              <!-- Meta Keyword -->
              <div class="mb-3">
                <label for="">Meta Keyword</label>
                <textarea name="meta_keyword" class="form-control" rows="4">
                {{$product->meta_keyword}}
                </textarea>
              </div>
            </div>
            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
              <div class="row">
                <div class="col-md-12">
                  <!-- Original Price field -->
                  <div class="mb-3">
                    <label for="">Original Price</label>
                    <input type="text" name="original_price" value="{{ $product->original_price }}" class="form-control">
                  </div>
                  <!-- Selling Price field -->
                  <div class="mb-3">
                    <label for="">Selling Price</label>
                    <input type="text" name="selling_price" value="{{ $product->selling_price }}" class="form-control">
                  </div>
                  <!-- Quantity field -->
                  <div class="mb-3">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control">
                  </div>

                  <div class="mb-3">
                    <!-- Trending field -->
                    <label for="">Trending</label>
                    <!-- <input type="checkbox" value="{{ $product->trending == '1' ? 'checked': '' }}" name="trending" style="width: 50px; height: 50px;"> -->
                    <input type="checkbox" {{ $product->trending == '1' ? 'checked' : '' }} name="trending" style="width: 50px; height: 50px;">


                    <!-- Status field -->
                    <label for="">Status</label>
                    <!-- <input type="checkbox" value="{{ $product->status == '1' ? 'checked': '' }}" name="status" style="width: 50px; height: 50px;"> -->
                    <input type="checkbox" {{ $product->status == '1' ? 'checked' : '' }} name="status" style="width: 50px; height: 50px;">
                  </div>

                </div>
              </div>
            </div>
            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
              <div class="mb-3">
                <label for="">Upload Product Image</label>
                <input type="file" name="image[]" multiple class="form-control">
              </div>

              <div>
                @if($product->productImages)
                <div class="row">
                  @foreach($product->productImages as $image)
                  <div class="col-md-4">
                    <img src="{{ asset($image->image) }}" style="width: 80px;height:80px" alt="img" class="me-4">
                    <a href="{{route('product-delete-image', $image->id )}}" class="d-block mb-2">Remove</a>
                  </div>
                  @endforeach

                  @else
                  <h5>No image Added</h5>
                  @endif

                </div>
              </div>
            </div>
            <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" tabindex="0">
              <!-- untuk warna yang belum ada -->
              <div class="mb-3">
                <h4>Add Product Color</h4>
                <label for="">Select Color</label>
                <hr />
                <div class="row">
                  @forelse($colors as $colorItem)
                  <div class="col-md-3">
                    <div class="p-2 border mb-3">
                      Color : <input type="checkbox" name="colors[{{$colorItem->id}}]" value="{{$colorItem->id}}">
                      {{$colorItem->name}}
                      <br>
                      Quantity : <input type="number" name="colorquantity[{{$colorItem->id}}]" style="width: 70px; border: 1px solid">
                    </div>
                  </div>
                  @empty
                  <div class="col-md-12">
                    <h4>No Color Found</h4>
                  </div>
                  @endforelse
                </div>
              </div>

              <!-- ini yang udah ada colornya -->
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Color Name</th>
                      <th>Quantity</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($product->productColors as $prodColor)
                    <tr class="prod-color-tr">
                      <!-- class prod-col-tr diatambahakn setelah update class -->
                      <!-- if else ditambhakan ketika nama sudah muncul -->
                      <td>
                        @if($prodColor->color)
                        {{$prodColor->color->name}}
                        @else
                        No color Found
                        @endif
                      </td>

                      <td>
                        <div class="input-group mb-3" style="width: 150px">
                          <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm">
                          <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                        </div>
                      </td>
                      <!-- class updateProductColorBtn ditambahkan kerika sudah nambahin if else -->
                      <td>
                        <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                      </td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>
            <div>
              <button type="submit" class="btn btn-primary text-white">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection


<!-- tambahakan ini, abis itu yield ke layots.admin -->
@section('scripts')

<script>
  $(document).ready(function() {

    // laravel ajax, CSRF token diambil dari admin.blade disitu ada
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // Update data
    $(document).on('click', '.updateProductColorBtn', function() {

      var product_id = "{{ $product->id }}";
      var prod_color_id = $(this).val();
      var quantity = $(this).closest('.prod-color-tr').find('.productColorQuantity').val(); //untuk mendapatkan kuantitas yang ada pada tag input
    
      if(quantity <= 0) {
        alert('Quantity is required');
          return false;
      }
      var data = {
        'product_id': product_id,
        'quantity': quantity
      };

      $.ajax({
        type: "POST",
        url: "/admin/product-color/" +prod_color_id ,
        data: data,
        success: function(response) {
          alert(response.message);  //message dari controller

        }
      });

    });

    // delete data
    $(document).on('click', '.deleteProductColorBtn', function() {
      var prod_color_id = $(this).val(); //untuk mendapatkan id color
      var thisClick = $(this);

      $.ajax({
        type  : "GET",
        url   : "/admin/product-color/" + prod_color_id + "/delete",
        success: function(response) {
          thisClick.closest('.prod-color-tr').remove();
          alert(response.message);  //message dari controller
        }
      })
    });

  });
</script>

@endsection