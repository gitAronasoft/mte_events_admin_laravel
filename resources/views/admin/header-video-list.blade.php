@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Header Video List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Header Video List</a></li>
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
                        <h5 style="margin-top:17px;">Header Video List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ URL::to('admin/header/video/add') }}" class="btn btn-success text-dark"><i class="fa fa-plus"></i> Add New Video</a>
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Feature Image</th> 
                                <th class="text-center">Video</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                            @foreach($headerVideos as $headerVideo)
                                @php
                                    $video_id = explode("?v=", $headerVideo->video_url); // For videos like http://www.youtube.com/watch?v=
                                    
                                    if(empty($video_id[1]))
                                        $video_id = explode("/v/", $headerVideo->video_url); // For videos like http://www.youtube.com/watch/v/
                                    
                                    $video_id = explode("&", $video_id[1]); // Deleting any other params
                                    $video_id = $video_id[0];
                                @endphp                                                                                  
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center" style="width:25%;">
                                        @if(!empty($headerVideo->featureImage))
                                            <img src="{{$headerVideo->featureImage}}" class="img-responsive" alt="" style="width:100%;"/>
                                        @else 
                                            <img src="{{ asset('/uploads/catalog-default-img.gif') }}" class="img-responsive" alt="" style="width:100%;"/>
                                        @endif
                                    </td>                                                                 
                                    <td class="text-center" style="width:30%;">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$video_id}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    </td>                                    
                                    <td class="text-center" style="width:30%;">
                                        @if($headerVideo->status=='active')
                                            <span class="text-success">Publish</span>
                                        @else 
                                            <span class="text-dander">Un-Publish</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width:30%;">
                                        <a href="{{ URL::to('admin/header/video/edit/'.$headerVideo->id) }}" class="btn btn-outline-primary" title="Edit"><i class="fa fa-eye"></i> Edit</a>
                                        <a href="{{ URL::to('admin/header/video/delete/'.$headerVideo->id) }}" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr> 
                                @php $i++; @endphp
                            @endforeach                             
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th> 
                                <th class="text-center">Feature Image</th>
                                <th class="text-center">Video</th>                                
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    {!! $headerVideos->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>                
            </div>
        </div>
    </div>
@endsection

@push('scripts')    

@endpush('scripts')