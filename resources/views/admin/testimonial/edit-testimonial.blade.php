@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Testimonials</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/testimonials')}}">Testimonials List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Edit Testimonial : {{$testimonialDetail->client_name}}</a></li>
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
                        <h5>Edit Testimonial : {{$testimonialDetail->client_name}}</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/testimonials')}}" class="btn btn-success text-dark">Testimonials List</a>
                        <a href="{{URL::to('admin/testimonials/add')}}" class="btn btn-info text-dark">Add Testimonials</a>
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
                {{ Form::open(array('url' => 'admin/testimonials/update' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <input type="hidden" name="id" value="{{encrypt($testimonialDetail->id)}}"/> 
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Client Name<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required name="client_name" value="{{$testimonialDetail->client_name}}" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend w-100">
                                <span class="input-group-text" id="basic-addon1">Description<sup class="text-danger">*</sup></span>
                            </div>
                            <textarea class="form-control ckeditor" name="testimonials" required aria-label="" aria-describedby="basic-addon1">{{$testimonialDetail->testimonials}}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Star Rating</label>
                                </div>
                                <select class="custom-select" required name="star_rating" id="inputGroupSelect01">                                    
                                    <option value="1" @if($testimonialDetail->star_rating=='1') selected @endif>1</option>
                                    <option value="2" @if($testimonialDetail->star_rating=='2') selected @endif>2</option>
                                    <option value="3" @if($testimonialDetail->star_rating=='3') selected @endif>3</option>
                                    <option value="4" @if($testimonialDetail->star_rating=='4') selected @endif>4</option>
                                    <option value="5" @if($testimonialDetail->star_rating=='5') selected @endif>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                </div>
                                <select class="custom-select" required name="status" id="inputGroupSelect01">                                    
                                    <option value="1" @if($testimonialDetail->status=='1') selected @endif>Active</option>
                                    <option value="2" @if($testimonialDetail->status=='2') selected @endif>Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <label class="font-weight-bold">Client Image</label>
                                <div class="input-group">                                
                                    <input type="file" name="client_image" class="" id="inputGroupFile01">
                                </div>
                            </div>
                            @if(!empty($testimonialDetail->client_image))
                                <img src="{{$testimonialDetail->client_image}}" alt=""  style="width: 25%;"/>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <label class="font-weight-bold">Featured Image</label>
                                <div class="input-group">                                
                                    <input type="file" name="feature_image" class="" id="inputGroupFile01">
                                </div>
                            </div>
                            @if(!empty($testimonialDetail->feature_image))
                                <img src="{{$testimonialDetail->feature_image}}" alt=""  style="width: 25%;"/>
                            @endif 
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
    <style>
        #cke_testimonials {
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