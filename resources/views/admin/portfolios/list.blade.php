@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Portfolios</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Portfolios</a></li>
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
                        <h5>Portfolios</h5>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
                <ul id="myTab" class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="photoGallery-tab" data-toggle="tab" href="#pills-photoGallery" role="tab" aria-controls="pills-photoGallery" aria-selected="false">
                            Photo Gallery
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="videoGallery-tab" data-toggle="tab" href="#pills-videoGallery" role="tab" aria-controls="pills-videoGallery" aria-selected="false">
                            Video Gallery
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-photoGallery" role="tabpanel" aria-labelledby="pills-photoGallery-tab">
                        <div class="col-lg-12 col-md-12 col-12">
                            <button type="button" data-toggle="modal" data-target="#photoGalleryPopup" class="btn btn-success w-100 text-dark">
                                <i class="fa fa-image"></i> Add Photos
                            </button>
                            <!--------------------- Photos upload popup --------------------------------->
                                <div id="photoGalleryPopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalCenterTitle">Uploads Photos</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="images-upload-form" method="POST"  action="javascript:void(0)" accept-charset="utf-8" enctype="multipart/form-data">
                                                    @csrf                                               
                                                    <div class="input-group cust-file-button">
                                                        <div class="custom-file">
                                                            <input type="file" name="images[]" accept="image/*" id="images" multiple  class="custom-file-input">
                                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append ml-2">
                                                            <button type="submit" class="btn btn-primary" id="submit"><i class="fa fa-save"></i> Save</button>
                                                        </div>                                                        
                                                    </div> 
                                                    <p class="upload-response mt-4 text-center font-weight-bold"></p>
                                                </form> 
                                                    @error('images')
                                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                    @enderror
                                                <div class="images-preview-div"> </div>                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!--------------------- End photos upload popup --------------------------------->
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="row">                                                       
                                @if(count($Portfolio_images)>0)                                 
                                    @foreach($Portfolio_images as $key=>$Portfolio_image)
                                    <div class="col-lg-3 col-md-4 col-6 col-sm-6 text-center mt-3"> 
                                        <div class="card">
                                            <div class="card-body"> 
                                                <a href="{{$Portfolio_image->portfolios_images}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                                                    <img src="{{$Portfolio_image->portfolios_images}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid" style="height:200px;"  alt="">
                                                </a> 
                                                <a class="btn btn-danger mt-3 removeImage" data-id="{{$Portfolio_image->id}}" style="cursor:pointer;color:#fff;"><i class="fa fa-trash"></i> Remove</a>                                                                              
                                            </div>
                                        </div> 
                                    </div>                                     
                                    @endforeach                                                               
                                @else
                                    <h5 class="text-danger text-center w-100 mt-4">No images...</h5>
                                @endif  
                            </div>                                           
                        </div>
                    </div>
                    <div class="tab-pane fade " id="pills-videoGallery" role="tabpanel" aria-labelledby="pills-videoGallery-tab">
                        <div class="col-md-12">
                            {{ Form::open(array('id' => 'videoUpload' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                                <lable class="font-weight-bold">Enter Youtube URL <sup class="text-danger">*</sup></lable>
                                <div class="input-group mt-2">                                    
                                    <input type="text" class="form-control videoUrl" value=""/>
                                    <div class="input-group-append">
                                        <button class="btn btn-success w-100 text-dark" type="submit"><i class="fa fa-save"></i> Save Video</button>
                                    </div>                                
                                </div>
                                <p class="upload-video-response mt-2 text-center font-weight-bold"></p>                                
                            {{ Form::close() }}                            
                        </div> 
                        <div class="col-md-12">
                            <div class="row">
                                @if(count($Portfolio_videos)>0)
                                    @foreach($Portfolio_videos as $key=>$Portfolio_video)
                                        @php
                                            $link = $Portfolio_video->upload_video;
                                            $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=
                                            if (empty($video_id[1]))
                                                $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/
                                            
                                            $video_id = explode("&", $video_id[1]); // Deleting any other params
                                            $video_id = $video_id[0];
                                        @endphp
                                        <div class="col-lg-3 col-md-4 col-6 col-sm-6 text-center mt-3"> 
                                            <div class="card">
                                                <div class="card-body" style="padding:0px;"> 
                                                    <iframe width="100%" height="150" src="https://www.youtube.com/embed/{{$video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                    <a class="btn btn-danger removeImage" data-id="{{$Portfolio_video->id}}" style="cursor:pointer;color:#fff;margin-bottom: 10px;margin-top: 8px;"><i class="fa fa-trash"></i> Remove</a>                                                                              
                                                </div>
                                            </div> 
                                        </div> 
                                    @endforeach
                                @else
                                    <h5 class="text-danger text-center w-100 mt-4">No videos...</h5>
                                @endif
                            </div>  
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')    
<script >
$(function() {
    // Multiple images preview with JavaScript
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
    $('#images').on('change', function() {  
        $('.images-preview-div').html('');     
        previewImages(this, 'div.images-preview-div');
    });
});

$(document).ready(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#images-upload-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let TotalFiles = $('#images')[0].files.length; //Total files
        let files = $('#images')[0];
        for (let i = 0; i < TotalFiles; i++) {
            formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);
        $.ajax({
            type:'POST',
            url: "{{ url('admin/portfolios/upload-photos')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(msg){
                $(".upload-response").text("Uploading images....").css('color','#333');
            },
            success: (response) => {  
                if(response.successUpload){
                    $(".upload-response").text(response.successUpload).css('color','#66c4a9');
                    setTimeout(function() {
                        $(".upload-response").text('');
                        window.location.href = "{{ url('admin/portfolios')}}";                     
                    }, 3000);
                } else if(response.errorMsg) {
                    $(".upload-response").text(response.errorMsg).css('color','red');
                    setTimeout(function() {
                        $(".upload-response").text('');                    
                    }, 3000);
                } else {
                    $(".upload-response").text('Please choose images').css('color','red');
                    setTimeout(function() {
                        $(".upload-response").text('');                                          
                    }, 3000);
                }        
            },
            error: function(response){                
            }
        });
    });
});

$(document).on('click', '.removeImage', function() { 
    const imageID = $(this).attr('data-id');   
    $.ajax({
        type: 'get',
        datatype: 'json',
        url: "{{ URL::to('admin/portfolios/image-delete',) }}/" + imageID,
        beforeSend: function () {   
            $(this).css('display','none');           
        },
        success: function (response) {
            //$("#cartData").html(response);
            location.reload();                
        },
        complete: function () {              
        }
    });
});

$(document).ready(function (e) {    
    $('#videoUpload').submit(function(e) {
        e.preventDefault();
        let videoUrl = $('.videoUrl').val();
        var formData = new FormData(this);
        formData.append('videoUrl', videoUrl);
        $.ajax({
            type:'POST',
            url: "{{ url('admin/portfolios/upload-videos')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(){
                $(".upload-video-response").text("Uploading video....").css('color','#333');
            },
            success: (response) => {  
                if(response.successUpload){
                    $(".upload-video-response").text(response.successUpload).css('color','#66c4a9');
                    setTimeout(function() {
                        $(".upload-video-response").text('');
                        window.location.href = "{{ url('admin/portfolios')}}";                     
                    }, 3000);
                } else if(response.errorMsg) {
                    $(".upload-video-response").text(response.errorMsg).css('color','red');
                    setTimeout(function() {
                        $(".upload-video-response").text('');                    
                    }, 3000);
                } else {
                    $(".upload-video-response").text('Please enter youtube URL.').css('color','red');
                    setTimeout(function() {
                        $(".upload-video-response").text('');                                          
                    }, 3000);
                }        
            },
            error: function(response){                
            }
        });
    });
});

</script>
@endpush('scripts')