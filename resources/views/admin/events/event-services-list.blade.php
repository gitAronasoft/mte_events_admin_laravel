@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Events Services List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Events Services List</a></li>
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
                        <h5>Services List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/event/sevices/add')}}" class="btn btn-success text-dark">Add New Service</a>
                    </div>
                </div>                
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Total Event</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($eventsevicesList as $eventsevices)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">{{count($eventsevices->EventByService)}}</td>
                                    <td class="text-center">
                                        @if(!empty($eventsevices->featureImage))
                                            <img src="{{$eventsevices->featureImage}}" alt="{{$eventsevices->slug}}" style="border-radius:10px;width:100px;" />
                                        @else 
                                            <img src="{{ URL::asset('/uploads/catalog-default-img.gif') }}" alt="{{$eventsevices->slug}}" style="border-radius:10px;width:100px;" />
                                        @endif
                                    </td>
                                    <td class="text-center">{{$eventsevices->title}}</td>
                                    <td class="text-center">{!! Str::of($eventsevices->decription)->words(8, '...') !!}</td>
                                    <td class="text-center">
                                        @if($eventsevices->status=='publish')
                                            <span class="text-success">Publish</span>
                                        @elseif($eventsevices->status=='unpublish')
                                            <span class="text-danger">Un Publish</span>
                                        @else
                                            <span class="text-dark">Null</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/event/sevices/edit/'.$eventsevices->slug) }}" class="btn btn-outline-primary">Edit</a>
                                        <!-- <a href="" class="btn btn-outline-danger">Delete</a> -->
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {!! $eventsevicesList->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection