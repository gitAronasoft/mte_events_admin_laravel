@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Profile</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!}">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 p-0">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="padding-top:10px;">Profile</h5>
                    </div>                    
                </div>                
            </div>            
            <div class="card-body">
                <div class="message">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                </div>                
                {{ Form::open(array('url' => 'admin/profile' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    
                    <div class="form-row">                   
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Name<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="text" class="form-control" required name="name" value="{{ Auth::user()->name ?? '' }}" aria-label="" aria-describedby="basic-addon1">                                
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Email<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="email" class="form-control" required name="email" value="{{ Auth::user()->email ?? '' }}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>                     

                    <div class="form-row mt-3"> 
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">New Password</button>
                                </div>
                                <input type="password" class="form-control" name="password" value="" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>                       
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Profile Image</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="profilePic" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>                            
                        </div>                        
                    </div>                   
                    
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">Save</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>    
@endsection
@push('scripts')    
    
@endpush('scripts')