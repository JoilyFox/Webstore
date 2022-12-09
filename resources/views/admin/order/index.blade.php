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
              <h1 class="m-0">All Orders: {{count($orders)}}</h1>
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
                            <th style="width: 20%">
                                Full name
                            </th>
                            <th style="width: 25%">
                                Email
                            </th>
                            <th style="width: 15%">
                                Telephone
                            </th>
                            <th style="width: 10%">
                                Order details
                            </th>
                            <th style="width: 15%">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->id }}
                                </td>
                                <td>
                                    {{ $order->name }} {{ $order->surname }} 
                                </td>
                                <td>
                                    {{ $order->email }}
                                </td>
                                <td>
                                    {{ $order->tel }}
                                </td>
                                <td>

                                    <a class="images cursor-pointer" data-toggle="modal" data-target="#modal-lg-{{ $order->id }}" title="Click for more">
                                        <button type="button" class="btn btn-block btn-default btn-sm">More info</button>
                                    </a>
                                    
                                    
                                    {{-- Modal --}}
                                    <div class="modal fade" id="modal-lg-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Products: {{count($order->products)}}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <div class="row">
                                                    <div class="col-12">
                                                      <div class="card">
                                                        <div class="card-body table-responsive p-0">
                                                          <table class="table table-hover text-nowrap">
                                                            <thead>
                                                              <tr>
                                                                <th style="width: 1%">Product id</th>
                                                                <th style="width: 20%">Product name</th>
                                                                <th style="width: 10%">Size</th>
                                                                <th style="width: 10%">Quantity</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order->products as $product)
                                                                    <tr>
                                                                        <td>{{$product->product->id}}</td>
                                                                        <td>{{$product->product->title}}</td>
                                                                        <td>{{$product->size}}</td>
                                                                        <td>{{$product->qty}}</td>
                                                                    </tr>
                                                                  
                                                                @endforeach
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                        <!-- /.card-body -->
                                                      </div>
                                                      <!-- /.card -->
                                                    </div>
                                                  </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                </td>
                                <td>
                                    @if ($order->status)
                                        <span class="badge badge-success">Success</span>
                                    @else 
                                        <span class="badge badge-danger">Not complete</span>
                                    @endif
                                </td>
                                <td class="project-actions text-right d-flex justify-content-center flex-wrap">
                                    <form action="{{ route('order.update', $order->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info btn-sm mb-1 mr-1">
                                            Complete!
                                        </button>
                                    </form>
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash">
                                            </i>
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
    