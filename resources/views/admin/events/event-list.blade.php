@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Events List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Events List</a></li>
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
                        <h5>Events List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/event/add')}}" class="btn btn-success text-dark">Add New Event</a>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Event Type</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Date/Time</th>
                                <th class="text-center">Tickets</th>
                                <th class="text-center">Ticket Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($eventList as $events)
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">
                                    @if(!empty($events->featureImage))
                                        <img src="{{$events->featureImage}}" alt="{{$events->slug}}" style="border-radius:10px;" class="w-50"/>
                                    @else 
                                        <img src="{{ URL::asset('/uploads/catalog-default-img.gif') }}" alt="{{$events->slug}}" style="border-radius:10px;" class="w-50" />
                                    @endif
                                    </td>
                                    <td class="text-center">{{$events->servciesName->title}}</td>
                                    <td class="text-center">{{$events->title}}</td>
                                    <td class="text-center">{{$events->eventLocation}}</td>
                                    <td class="text-center">
                                        <p>{{$events->eventDate}}</p>
                                        <p>{{$events->eventTime}}</p>
                                    </td>
                                    <td class="text-center">
                                        {{$events->eventTickets}}
                                    </td>
                                    <td class="text-center">
                                        ${{$events->eventTicketsPrice}}
                                    </td>
                                    <td class="text-center">
                                        @if($events->status=='publish')
                                            <span class="text-success">Publish</span>
                                        @elseif($events->status=='unpublish')
                                            <span class="text-danger">Un Publish</span>
                                        @else
                                            <span class="text-dark">Null</span>
                                        @endif
                                    </td>                                    
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/event/edit/'.$events->slug) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Edit</a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {!! $eventList->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection