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
              <h1 class="m-0">Add Subcategory</h1>
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
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label for="subcategoryName">Name</label>
                          <input type="test" name="title" class="form-control" id="subcategoryName" placeholder="Enter subcategory name" required>
                        </div>

                        <div class="row">
                          <div class="col-sm-4">
                            <!-- select -->
                            <div class="form-group">
                              <label for="categoriesSelect">Select Category</label>
                              <select class="custom-select" id="categoriesSelect" name="category_id">
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create subcategory</button>
                      </div>
                    </form>
                  </div>
              </div>
            </div>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    

@endsection
    