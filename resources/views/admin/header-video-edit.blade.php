@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Header Video</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/header/video') }}">Header Video List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Edit Header Video</a></li>
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
                        <h5 style="margin-top:17px;">Edit Header Video </h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ URL::to('admin/header/video') }}" class="btn btn-success text-dark">Header Video List</a>
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
                <hr>
                {{ Form::open(array('url' => 'admin/header/video/edit/'.$videoDetail->id , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <input type="hidden" class="form-control" required="" name="id" value="{{$videoDetail->id}}" aria-label="" aria-describedby="basic-addon1">
                    <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8" style="border-right:1px solid rgba(0, 0, 0, 0.1);">
                            <div class="form-row mt-3">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Enter Youtube URL <sup class="text-danger">*</sup></span>
                                        </div>
                                        <input type="text" class="form-control" required="" name="video_url" value="{{$videoDetail->video_url}}" aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>                                                       
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if(!empty($videoDetail->video_url))                                    
                                        @php
                                            $video_id = explode("?v=", $videoDetail->video_url); // For videos like http://www.youtube.com/watch?v=
                                            if(empty($video_id[1]))
                                                $video_id = explode("/v/", $videoDetail->video_url); // For videos like http://www.youtube.com/watch/v/
                                            $video_id = explode("&", $video_id[1]); // Deleting any other params
                                            $video_id = $video_id[0];
                                        @endphp                                         
                                        <div class="card" style="margin-top:20px;">
                                            <div class="card-body" style="padding:0px;"> 
                                                <iframe width="100%" height="150" src="https://www.youtube.com/embed/{{$video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            </div>
                                        </div>                                                                                                    
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="featureImage-preview-div">
                                        @if(!empty($videoDetail->featureImage)) 
                                            <img src="{{$videoDetail->featureImage}}" style="margin-top:0px;"/>
                                        @endif
                                    </div> 
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-row mt-4">
                                <div class="form-group col-md-12">
                                    <div class="input-group cust-file-button">                                        
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose Feature Image</label>
                                            <input type="file" name="featureImage" accept="image/*" id="featureImage" class="custom-file-input">
                                        </div>                                                                                               
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row mt-3">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Status</span>
                                        </div>
                                        <select class="custom-select" name="status" id="inputGroupSelect01">
                                            <option value="active" @if($videoDetail->video_url=='active') selected @endif>Publish</option>
                                            <option value="unactive" @if($videoDetail->video_url=='unactive') selected @endif>Un-Publish</option>
                                        </select>
                                    </div>
                                </div>                                                       
                            </div>
                            <div class="form-group text-center mt-2">
                                <button class="btn btn-info w-100 text-dark" type="submit">Save</button>
                            </div>
                        </div>
                    </div>                 
                {{ Form::close() }}              
            </div>
        </div>
    </div>
@endsection

@push('scripts')    
    <script>
        $(function() {
            var previewImages = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };          

            $('#featureImage').on('change', function() {  
                $('.featureImage-preview-div').html('');     
                previewImages(this, 'div.featureImage-preview-div');
            });         
        }); 
    </script>
@endpush('scripts')