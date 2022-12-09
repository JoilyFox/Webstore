@extends('layouts.admin-layout')

{{-- Title --}}
@section('title', 'Edit Category')

{{-- Content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Editing a category: {{ $category->title }}</h1>
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
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
                        <div class="form-group">
                          <label for="categoryName">Name</label>
                          <input type="test" value="{{ $category->title }}" name="title" class="form-control" id="categoryName" placeholder="Enter category name" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryName">Select gender</label>
                            @if ($category->gender_id == 0)
                                <div class="form-check">
                                    <input class="form-check-input" id="rg1" type="radio" name="gender" checked="" value="0">
                                    <label class="form-check-label" for="rg1">Men</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="rg2" type="radio" name="gender" value="1">
                                    <label class="form-check-label" for="rg2">Women</label>
                                </div>
                            @elseif ($category->gender_id == 1)
                                <div class="form-check">
                                    <input class="form-check-input" id="rg1" type="radio" name="gender" value="0">
                                    <label class="form-check-label" for="rg1">Men</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="rg2" type="radio" name="gender" checked="" value="1">
                                    <label class="form-check-label" for="rg2">Women</label>
                                </div>
                            @endif
                          </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update category</button>
                      </div>
                    </form>
                  </div>
              </div>
            </div>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    

@endsection
    