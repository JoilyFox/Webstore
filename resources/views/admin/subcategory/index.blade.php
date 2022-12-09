@extends('layouts.admin-layout')

{{-- Title --}}
@section('title', 'All Categories')

{{-- Content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">All Subcategories: {{count($subcategories)}}</h1>
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

          <section class="content">
            <!-- Default box -->
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 3%">
                                Id
                            </th>
                            <th style="width: 20%">
                                Title
                            </th>
                            <th style="width: 20%">
                                Slug
                            </th>
                            <th style="width: 20%">
                                Category
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>
                                    {{ $subcategory->id }}
                                </td>
                                <td>
                                    <a href="{{ route('getProductsByCategory', [$subcategory->category->slug, $subcategory->slug]) }}">
                                        {{ $subcategory->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $subcategory->slug }}
                                </td>
                                <td class="project-state text-left">
                                    {{ $subcategory->category->title }}
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm mb-1" href="{{ route('subcategory.edit', $subcategory->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn" href="#" >
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>         
                        @endforeach               
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
          </section>

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    

@endsection
    