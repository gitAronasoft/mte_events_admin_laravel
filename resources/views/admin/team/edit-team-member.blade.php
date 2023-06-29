@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Team Member</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/teams')}}">Team List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Edit Team Member : {{$memberDetail->name}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 p-0">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 style="padding-top:10px;">Edit Team Member : {{$memberDetail->title}}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/teams')}}" class="btn btn-success text-dark"><i class="fa fa-users"></i> Team List</a>
                        <a href="{{URL::to('admin/teams/add')}}" class="btn btn-info text-dark">Add New Event</a>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
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
                {{ Form::open(array('url' => 'admin/teams/update' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <input type="hidden" name="id" value="{{encrypt($memberDetail->id)}}"/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Name<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required name="name" value="{{$memberDetail->name}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Email<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="email" class="form-control" required name="email" value="{{$memberDetail->email}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Mobile no<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control numberonly" required name="mobile" value="{{$memberDetail->mobile}}" aria-label="" aria-describedby="basic-addon1">
                                <small class="w-100 text-center text-danger">Note: Enter only numbers.</small>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Designation<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required name="designation" value="{{$memberDetail->designation}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Gender</span>
                                </div>
                                <select class="custom-select" name="gender" id="inputGroupSelect01">
                                    <option value="Male" @if($memberDetail->gender=='Male') selected @endif>Male</option>
                                    <option value="Female" @if($memberDetail->gender=='Female') selected @endif>Female</option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Address</span>
                                </div>
                                <input type="text" class="form-control" name="address" value="{{$memberDetail->address}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Choose Profile Image</label>
                            <div class="input-group">                                
                                <input type="file" name="image" class="" id="inputGroupFile01">
                            </div>
                            @if(!empty($memberDetail->image))
                                <img src="{{$memberDetail->image}}" alt="{{$memberDetail->slug}}"  style="width: 60px;margin-top: 20px;"/>
                            @else
                                @if($memberDetail->gender=='Male')
                                    <img src="{{ URL::asset('uploads/dummy-profile.png') }}" style="width: 60px;margin-top: 20px;" alt="{{$memberDetail->slug}}">
                                @elseif($memberDetail->gender=='Female')
                                    <img src="{{ URL::asset('uploads/girl-profile-pic.png') }}" style="width: 60px;margin-top: 20px;" alt="{{$memberDetail->slug}}">
                                @else
                                    <img src="{{ URL::asset('uploads/dummy-profile.png') }}" style="width: 60px;margin-top: 20px;" alt="{{$memberDetail->slug}}">
                                @endif
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Status</span>
                                </div>
                                <select class="custom-select" name="status" id="inputGroupSelect01">
                                    <option value="active" @if($memberDetail->status=='active') selected @endif>Active</option>
                                    <option value="unactive" @if($memberDetail->status=='unactive') selected @endif>Un active</option>                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Facebook</span>
                                </div>
                                <input type="text" class="form-control" name="facebook_url" value="{{$memberDetail->facebook_url}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Twitter</span>
                                </div>
                                <input type="text" class="form-control" name="twitter_url" value="{{$memberDetail->twitter_url}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Linkedin</span>
                                </div>
                                <input type="text" class="form-control" name="linkedin_url" value="{{$memberDetail->linkedin_url}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-12">                        
                            <button class="btn btn-success text-dark" type="submit"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection