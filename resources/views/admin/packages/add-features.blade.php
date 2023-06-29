@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add New Features</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/packages/features')}}">Features List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Add New Features</a></li>
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
                        <h5 style="padding-top:10px;">Add New Features</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/packages/features')}}" class="btn btn-info text-dark">Features List</a>
                    </div>
                </div>                
            </div>            
            <div class="card-body">
                <hr>
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
                {{ Form::open(array('url' => 'admin/packages/add-feature' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <div class="form-row mt-4">                        
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Feature Name <sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required="" name="feature_name" value="" aria-label="" aria-describedby="basic-addon1">
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