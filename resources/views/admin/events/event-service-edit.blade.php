@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Events Edit Services</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/event/sevices/list')}}">Events Services List</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{$servicesDetail->title}}</a></li>
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
                        <h5 style="padding-top:10px;">Service : {{$servicesDetail->title}}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/event/sevices/list')}}" class="btn btn-info text-dark">Services List</a>
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
                {{ Form::open(array('url' => 'admin/event/sevices/update' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <input type="hidden" name="id" value="{{encrypt($servicesDetail->id)}}"/>
                    <div class="form-group mt-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Title<sup class="text-danger">*</sup></span>
                            </div>
                            <input type="text" class="form-control" required name="title" value="{{$servicesDetail->title}}" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Description<sup class="text-danger">*</sup></span>
                            </div>
                            <textarea class="form-control ckeditor" name="decription" required aria-label="" aria-describedby="basic-addon1">
                                {{$servicesDetail->decription}}
                            </textarea>
                        </div>
                    </div>
                    <div class="form-row mt-4">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                </div>
                                <select class="custom-select" name="status" id="inputGroupSelect01">
                                    <option value="publish" @if($servicesDetail->status=='publish') selected @endif>Publish</option>
                                    <option value="unpublish" @if($servicesDetail->status=='unpublish') selected @endif>Un-Publish</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Feature Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="featureImage" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            @if(!empty($servicesDetail->featureImage))
                                <img src="{{$servicesDetail->featureImage}}" alt="{{$servicesDetail->slug}}" style="border-radius:10px;" class="w-50"/>
                            @else 
                                <img src="{{ URL::asset('/uploads/catalog-default-img.gif') }}" alt="{{$servicesDetail->slug}}" style="border-radius:10px;" class="w-50" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info" type="submit">Save</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <style>
        #cke_decription {
            width:100%;
        }
    </style>
@endsection
@push('scripts')    
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.ckeditor').ckeditor();
        });       
    </script>
@endpush('scripts')