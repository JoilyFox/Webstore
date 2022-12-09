@extends('layouts.admin-layout')

{{-- Title --}}
@section('title', 'All Products')

{{-- Content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">All Products: {{count($products)}}</h1>
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
                            <th style="width: 1%">
                                Id
                            </th>
                            <th style="width: 15%">
                                Title
                            </th>
                            <th style="width: 10%">
                                Subcategory
                            </th>
                            <th style="width: 7%">
                                Sales
                            </th>
                            <th style="width: 30%">
                                Description
                            </th>
                            <th style="width: 10%">
                                Price
                            </th>
                            <th style="width: 10%">
                                Available
                            </th>
                            <th style="width: 20%">
                                Images
                            </th>
                            <th style="">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <a href="{{route('getProduct', [$product->subcategory->category['slug'], $product->subcategory['slug'], $product['slug']])}}">
                                        {{ $product->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $product->subcategory->title }}
                                </td>
                                <td>
                                    {{ $product->bought }}
                                </td>
                                <td class="project-state text-left truncate-text pb-0 cursor-pointer moreDescription mb-12" title="Click for more">
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    <a>
                                        @if ($product->in_stock == 1)
                                            In inStock
                                        @else 
                                            Not in stock
                                        @endif
                                    </a>
                                </td>
                                <td class="p-1">
                                    {{-- Btn images --}}
                                        @if (count($product->images) >= 2)
                                            <a class="images cursor-pointer" data-toggle="modal" data-target="#modal-lg-{{ $product->id }}" title="Click for more">
                                                <img loading="lazy" src="{{ asset('/storage/' . $product->images[0]->img) }}" alt="{{ $product->title }}">
                                                <img loading="lazy" src="{{ asset('/storage/' . $product->images[1]->img) }}" alt="{{ $product->title }}">
                                            </a>
                                        @elseif (count($product->images) == 1)
                                            <a class="images cursor-pointer" data-toggle="modal" data-target="#modal-lg-{{ $product->id }}" title="Click for more">
                                                <img loading="lazy" src="{{ asset('/storage/' . $product->images[0]->img) }}" alt="{{ $product->title }}">
                                            </a>
                                        @elseif (count($product->images) == 0)
                                            No images
                                        @endif
             
                                    {{-- Modal --}}
                                    <div class="modal fade" id="modal-lg-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Images: {{count($product->images)}}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                @if (count($product->images) !== 0)
                                                    @foreach ($product->images as $image)
                                                        <img loading="lazy" src="{{ asset('/storage/' . $image->img) }}" alt="{{ $product->title }}" class="modal-image">
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm mb-1" href="{{ route('product.edit', $product->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline-block">
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
    