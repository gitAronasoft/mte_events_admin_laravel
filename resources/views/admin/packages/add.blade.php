@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Package</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/packages/list')}}">Packages List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Add Package</a></li>
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
                        <h5 style="padding-top:10px;">Add New Package</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/packages/list')}}" class="btn btn-info text-dark">Packages List</a>
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
                {{ Form::open(array('url' => 'admin/packages/add' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <div class="form-row mt-4">                        
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Title<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required="" name="title" value="" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Price ($)<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control allow_number_decimal" required name="price" value="" aria-label="" aria-describedby="basic-addon1">
                                <small class="w-100 text-center text-danger">Note: Enter only numbers.</small>
                            </div>
                        </div>
                    </div>              
                    
                    <div class="form-group">
                        <p class="font-weight-bold">Select Package Features<sup class="text-danger">*</sup></p>
                        @if(count($features)>0)
                            @foreach($features as $feature)
                                <div class="custom-control custom-checkbox w-100">
                                    <input type="checkbox" name="features[]" value="{{$feature->id}}" class="custom-control-input" id="checked{{$feature->id}}">
                                    <label class="custom-control-label" for="checked{{$feature->id}}"> {{$feature->feature_name}}</label>
                                </div>
                            @endforeach
                        @else 
                            <p class="font-weight-bold text-danger">Add new feature <a href="{{URL::to('admin/packages/add-feature')}}">Click here</a></p>                            
                        @endif
                    </div>                                       
                                       
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">Save</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>    
@endsection