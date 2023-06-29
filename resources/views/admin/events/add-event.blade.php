@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Event</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/event/list')}}">Events List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Add Event</a></li>
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
                        <h5 style="padding-top:10px;">Add New Event</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/event/list')}}" class="btn btn-info text-dark">Events List</a>
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
                {{ Form::open(array('url' => 'admin/event/add' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    
                    <div class="form-row mt-4">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Services </label>
                                </div>
                                <select class="custom-select" required name="eventService" id="inputGroupSelect01">
                                    <option value="">Choose Event Service</option>
                                    @foreach($eventsevicesList as $eventsevices)
                                        <option value="{{$eventsevices->id}}">{{$eventsevices->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Title<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required name="title" value="" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Description<sup class="text-danger">*</sup></span>
                            </div>
                            <textarea class="form-control ckeditor" name="decription" required aria-label="" aria-describedby="basic-addon1"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-row">                        
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Total Tickets<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control numberonly" required name="eventTickets" value="" aria-label="" aria-describedby="basic-addon1">
                                <small class="w-100 text-center text-danger">Note: Enter only numbers.</small>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Tickets Price ($)<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control allow_number_decimal" required name="eventTicketsPrice" value="" aria-label="" aria-describedby="basic-addon1">
                                <small class="w-100 text-center text-danger">Note: Enter only numbers.</small>
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Date<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="text" class="form-control" required name="eventDate" id="datepicker" value="" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Time<sup class="text-danger">*</sup></span>
                                </div>
                                <input type="time" class="form-control" required name="eventTime" value="" aria-label="" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Location<sup class="text-danger">*</sup></span>
                            </div>
                            <input type="text" class="form-control" required name="eventLocation" value="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-row mt-3">                        
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Feature Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="featureImage" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Gallery</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="GalleryImages[]" accept="image/*" multiple class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12 col-lg-12 mt-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                </div>
                                <select class="custom-select" name="status" id="inputGroupSelect01">
                                    <option value="publish">Publish</option>
                                    <option value="unpublish">Un-Publish</option>
                                </select>
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