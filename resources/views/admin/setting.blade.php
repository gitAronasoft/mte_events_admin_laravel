@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">General Setting</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">General Setting</a></li>
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
                        <h5 style="padding-top:10px;">General Setting</h5>
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
                {{ Form::open(array('url' => 'admin/general-setting' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    
                    <div class="form-row">                   
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Site Name<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="text" class="form-control" required name="siteName" value="{{ $setting->siteName ?? '' }}" aria-label="" aria-describedby="basic-addon1">                                
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Support Number<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="text" class="form-control numberonly" required name="SiteSupportNumber" value="{{ $setting->SiteSupportNumber ?? '' }}" aria-label="" aria-describedby="basic-addon1">
                                <small class="w-100 text-center text-danger">Note: Enter only numbers.</small>
                            </div>
                        </div>
                    </div> 

                    <div class="form-row">                   
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Site Email<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="email" class="form-control" required name="siteEmail" value="{{ $setting->siteEmail ?? '' }}" aria-label="" aria-describedby="basic-addon1">                                
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Copy Right<sup class="text-danger">*</sup></button>
                                </div>
                                <input type="text" class="form-control numberonly" required name="SiteCopyRight" value="{{ $setting->SiteCopyRight ?? '' }}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="form-row mt-3">                        
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Site Logo</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="siteLogo" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            @if(!empty($setting->siteLogo))
                                <img src="{{ $setting->siteLogo }}" alt="{{ $setting->siteName ?? '' }}" class="img-responsive "/>
                            @endif
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Favicon</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="siteFavicon" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            @if(!empty($setting->siteFavicon))
                                <img src="{{ $setting->siteFavicon }}" alt="{{ $setting->siteName ?? '' }}" class="img-responsive"/>
                            @endif
                        </div>
                    </div>
                    <div class="form-row mt-3">                        
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Facebook Link</button>
                                </div>
                                <div class="custom-file">
                                    <input type="text" name="FacebookLink" value="{{ $setting->FacebookLink ?? '' }}" class="form-control" id="inputGroupFile01">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Twitter Link</button>
                                </div>
                                <div class="custom-file">
                                    <input type="text" name="TwitterLink" value="{{ $setting->TwitterLink ?? '' }}" class="form-control" id="inputGroupFile01">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3">                        
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Linkedin Link</button>
                                </div>
                                <div class="custom-file">
                                    <input type="text" name="LinkedinLink" value="{{ $setting->LinkedinLink ?? '' }}" class="form-control" id="inputGroupFile01">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-dark" type="button">Instagram Link</button>
                                </div>
                                <div class="custom-file">
                                    <input type="text" name="InstagramLink" value="{{ $setting->InstagramLink ?? '' }}" class="form-control" id="inputGroupFile01">
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