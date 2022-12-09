@extends('layouts.admin-layout')

{{-- Title --}}
@section('title', 'Add Category')

{{-- Content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Edit Product</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->

          @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>Success!</h5>
                {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            @foreach ($errors->all() as $error)
                <span>{{ $error }}</span><br>
            @endforeach
          </div>
          @endif

          <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <!-- form start -->
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="card-body">

                        {{-- Title --}}
                        <div class="form-group">
                          <label for="productName">Name</label>
                          <input value="{{ $product->title }}" type="test" maxlength="100" name="title" class="form-control" id="productName" placeholder="Enter product name" required>
                        </div>

                        <div class="p-0">
                          <!-- textarea -->
                          <div class="form-group">
                            <label for="descriptionArea">Description</label>
                            <textarea id="descriptionArea" name="description" maxlength="500" class="form-control" rows="3" required placeholder="Enter description" style="margin-top: 0px; margin-bottom: 0px; height: 98px;">{{ $product->description }}</textarea>
                          </div>
                        </div>

                        {{-- Subcategory --}}
                        <div class="row">

                          <div class="col-sm-4">
                            <!-- Subcategory -->
                            <div class="form-group">
                              <label for="subcategoriesSelect">Select Subcategory</label>
                              <select class="custom-select" id="subcategoriesSelect" name="subcategory_id" required>
                                @foreach ($subcategories as $subcategory)
                                  @if ($product->subcategory_id == $subcategory->id)
                                    <option selected value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                  @else
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>
                          </div>

                          {{-- Price --}}
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="price">Price ($)</label>
                              <input value="{{ $product->price }}" type="number" step="0.01" name="price" class="form-control" id="price" placeholder="Enter product price" required>
                            </div>
                          </div>

                          <div class="col-sm-2 ml-4">
                                {{-- In stock --}}
                            <div class="form-group">
                              <label>Available</label>
                              @if ($product->in_stock == 1)
                                <div class="form-check">
                                  <input class="form-check-input" id="inStock" type="radio" name="in_stock" checked="" value="1">
                                  <label class="form-check-label" for="inStock">In stock</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" id="notInStock" type="radio" name="in_stock" value="0">
                                  <label class="form-check-label" for="notInStock">Not in stock</label>
                                </div>
                              @else 
                                <div class="form-check">
                                  <input class="form-check-input" id="inStock" type="radio" name="in_stock" value="1">
                                  <label class="form-check-label" for="inStock">In stock</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" id="notInStock" type="radio" name="in_stock" checked="" value="0">
                                  <label class="form-check-label" for="notInStock">Not in stock</label>
                                </div>
                              @endif
                            </div>
                          </div>
                        </div>

                        {{-- Add Images --}}
                        <div class="form-group">
                          <label>Add image</label>
                          <div class="row">
                              <div class="col-sm-4 mb-2">
                                <div class="custom-file" class="custom-file-input">
                                  <input type="file" class="custom-file-input" class="imageInput" name="images[]" id="image_1" accept="image/png, image/jpeg">
                                  <label class="custom-file-label" for="image_1">Choose image 1</label>
                                </div>
                              </div>

                              <span id="addMoreImagesBtn" class="ml-2 btn btn-block btn-default col-sm-2 mb-2">Add more</span>
                          </div> 

                        </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update product</button>
                      </div>
                    </form>

                    {{-- Edit Images --}}
                    @if (count($product->images) !== 0)
                      <div class="card-body">
                        <div class="form-group">
                          <label>Delete images (if you need)</label>
                          <div class="row">
                            @foreach ($product->images as $image)
                                <div class="imageDiv">
                                  <img src="{{ asset('/storage/' . $image->img) }}" alt="{{ $product->title }}">
                                  <form action="{{ route('productImage.destroy', $image->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn" href="#" >
                                      <i class="fas fa-trash">
                                      </i>
                                    </button>
                                  </form>
                                </div>
                            @endforeach
                          </div>
                        </div>
                      </div> {{-- Edit Images --}}
                    @endif
                    
                  </div>
              </div>
            </div>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    

@endsection
    