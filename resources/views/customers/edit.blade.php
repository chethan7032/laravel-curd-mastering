@extends('layouts.app')
@section('content')
<body>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{route('customer.index')}}" class="btn" style="background-color: #4643d3; color: white;"><i class="fas fa-chevron-left"></i> Back</a>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                  <form action="{{route('customer.update',$customer->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                      <div class="row">
                        <img src="{{ asset($customer->image) }}" alt="avatar" style="width:100px;">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" value="{{old('image')}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{$customer->first_name}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{$customer->last_name}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$customer->email}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{$customer->phone}}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Bank Account Number</label>
                                <input type="text" class="form-control" name="account_number" value="{{$customer->bank_account_number}}">
                            </div>
                        </div>
                           <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">About you </label>
                                <textarea name="about"  class="form-control" cols="30" rows="3">{{$customer->about}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Update</button>
                        </div>

                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script src="./assets/js/fontawesome.js"></script>

</body>
    
@endsection