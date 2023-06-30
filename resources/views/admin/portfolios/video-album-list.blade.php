@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Video List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Video List</a></li>
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
                        <h5 style="margin-top:17px;">Video List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/portfolios/video/add')}}" class="btn btn-success text-dark"><i class="fa fa-plus"></i> Add New Video</a>
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
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th> 
                                <th class="text-center">Feature Image</th>
                                <th class="text-center">Video Title</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($videoAlbums)>0)
                            @php $i=1; @endphp
                            @foreach($videoAlbums as $key=>$albums)                                                          
                                <tr>
                                    <td class="text-center">{{$i}}</th>
                                    <td class="text-center" style="width:25%;">
                                        <img src="{{$albums->featureImage}}" class="img-responsive" alt="" style="width:30%;"/>
                                    </td>
                                                                  
                                    <td class="text-center">{{$albums->title}}</td>                                    
                                    <td class="text-center">
                                        @if($albums->status=='publish')
                                            <span class="text-success">Publish</span>
                                        @else 
                                            <span class="text-dander">Un-Publish</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/portfolios/video/edit/'.$albums->albumSlug) }}" class="btn btn-outline-primary" title="Edit"><i class="fa fa-eye"></i> Edit</a>
                                        <a href="{{ URL::to('admin/portfolios/video/delete/'.$albums->albumSlug) }}" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure, you want to delete it?')"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th> 
                                <th class="text-center">Feature Image</th>                            
                                <th class="text-center">Video Title</th>                                
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    {!! $videoAlbums->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>                
            </div>
        </div>
    </div>
@endsection

@push('scripts')    

@endpush('scripts')