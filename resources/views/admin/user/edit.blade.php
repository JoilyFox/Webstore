@extends('layouts.admin-layout')

{{-- Title --}}
@section('title', 'Edit Category')

{{-- Content --}}
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    



    <section class="content">

      

      <div class="container-fluid">

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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="mt-100-16 card card-primary card-outline">
              <div class="card-body box-profile">

                @php
                  if (Auth::user()->img !== null) 
                      $image = Auth::user()->img;
                  else 
                      $image = 'no_image.jpg';
                @endphp

                <div class="profile-user-img img-fluid text-center profile-img img-circle">
                  <img class="" src="{{ asset('/storage/' . $image ) }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                  @if (Auth::user()->first_name !== null || Auth::user()->last_name !== null)
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                  @else 
                    {{ Auth::user()->name }}
                  @endif
                </h3>

                <p class="text-muted text-center">Role: {{ Auth::user()->roles->first()->name }}</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-body card-primary card-outline">
              <form action="{{ route('user.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Element --}}
                <div class="form-group row">
                  <label for="inputLogin" class="col-sm-2 col-form-label">Nickname</label>
                  <div class="col-sm-10">
                    <input disabled type="text" class="form-control" id="inputLogin" placeholder="Email" value="{{Auth::user()->name}}">
                  </div>
                </div> {{-- //Element --}}

                {{-- Element --}}
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{Auth::user()->email}}">
                  </div>
                </div> {{-- //Element --}}

                {{-- Element --}}
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" id="inputName" placeholder="First Name" value="{{Auth::user()->first_name}}">
                  </div>
                </div> {{-- //Element --}}

                {{-- Element --}}
                <div class="form-group row">
                  <label for="inputLName" class="col-sm-2 col-form-label">Last Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" id="inputLName" placeholder="Last Name" value="{{Auth::user()->last_name}}">
                  </div>
                </div> {{-- //Element --}}

                {{-- Element --}}
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Avatar</label>
                  <div class="col-sm-6 mb-2">
                    <div class="custom-file" class="custom-file-input">
                      <input type="file" class="custom-file-input imageInput" name="image" id="image" accept="image/png, image/jpeg">
                      <label class="custom-file-label" for="image">Choose image</label>
                    </div>
                  </div>
                </div> {{-- //Element --}}
                
                <button type="submit" class="btn btn-primary col-sm-3 mt-3">Save Changes</button>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    

@endsection
    