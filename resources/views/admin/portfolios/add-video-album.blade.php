@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Video</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/portfolios/video/list')}}">Video List</a></li>
                        <li class="breadcrumb-item"><a href="#!">Add Video</a></li>
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
                        <h5 style="margin-top:17px;">Add Video</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/portfolios/video/list')}}" class="btn btn-success text-dark"><i class="fa fa-list"></i> Video List</a>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
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
                {{ Form::open(array('url' => 'admin/portfolios/video/add' , 'autocomplete'=>'off', 'enctype' =>'multipart/form-data')) }}
                    <div class="row">
                        <div class="col-sm-8 col-md-8 col-lg-8" style="border-right:1px solid rgba(0, 0, 0, 0.1);">
                            <div class="form-row mt-4">                        
                                <div class="form-group col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Video Title<sup class="text-danger">*</sup></span>
                                        </div>
                                        <input type="text" class="form-control" required="" name="title" value="" aria-label="" aria-describedby="basic-addon1">
                                    </div>
                                </div>                        
                            </div> 
                            <div class="form-row mt-3">                        
                                <div class="form-group col-md-12">
                                    <div class="field_wrapper">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Enter Youtube URL <sup class="text-danger">*</sup></span>
                                            </div>
                                            <input type="text" class="form-control" required="" name="youtube_url" value="" aria-label="" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="featureImage-preview-div"> </div>
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
                                            <option value="publish">Publish</option>
                                            <option value="unpublish">Un-Publish</option>
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
        
        // $(document).ready(function(){
        //     var maxField = 50;
        //     var addButton = $('.add_button');
        //     var wrapper = $('.field_wrapper'); 
        //     var fieldHTML = '<div class="input-group mt-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">Enter Youtube URL </div><input type="text" class="form-control" name="youtube_url[]" value=""/><a href="javascript:void(0);" class="btn btn-danger remove_button"><i class="fa fa-trash"></i> Delete</a></div>'; //New input field html 
        //     var x = 1;
            
        //     $(addButton).click(function(){
                
        //         if(x < maxField){ 
        //             x++;
        //             $(wrapper).append(fieldHTML);
        //         }
        //     });
            
        //     $(wrapper).on('click', '.remove_button', function(e){
        //         e.preventDefault();
        //         $(this).parent('div').remove();
        //         x--;
        //     });
        // });
        
    </script>
@endpush('scripts')