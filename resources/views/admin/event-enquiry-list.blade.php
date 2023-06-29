@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Event Enquiry List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Event Enquiry List</a></li>
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
                        <h5>Event Enquiry List</h5>
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
                                <th class="text-center">Event</th>                                
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Date Event</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Guest Count</th>
                                <th class="text-center">eBudget</th>
                                <th class="text-center">Know About</th>
                                <th class="text-center">Other Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($eventenquiryList as $team)                                                       
                                <tr>
                                    <td class="text-center">{{$i}}</td>                                    
                                    <td class="text-center">{{$team->event}}</td>
                                    <td class="text-center">{{$team->fullName}}</td>
                                    <td class="text-center">{{$team->email}}</td>
                                    <td class="text-center">{{$team->phone}}</td> 
                                    <td class="text-center">{{$team->company}}</td> 
                                    <td class="text-center">{{$team->website}}</td> 
                                    <td class="text-center">{{$team->dateevent}}</td> 
                                    <td class="text-center">{{$team->location}}</td> 
                                    <td class="text-center">{{$team->venue}}</td> 
                                    <td class="text-center">{{$team->guestCount}}</td> 
                                    <td class="text-center">{{$team->eBudget}}</td> 
                                    <td class="text-center">{{$team->knowAbout}}</td> 
                                    <td class="text-center">{{$team->otherInfo}}</td> 
                                                                  
                                </tr> 
                                @php $i++; @endphp
                            @endforeach                             
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection