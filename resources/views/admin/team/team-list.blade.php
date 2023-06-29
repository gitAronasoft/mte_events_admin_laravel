@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Team List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Team List</a></li>
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
                        <h5>Team List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/teams/add')}}" class="btn btn-success text-dark">Add Team Member</a>
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
                                <th class="text-center">Image</th>                                
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Designation</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($teams as $team)                                                       
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">
                                    @if(!empty($team->image))
                                        <img src="{{$team->image}}" alt="{{$team->slug}}"  class="img-radius wid-40"/>
                                    @else
                                        @if($team->gender=='Male')
                                            <img src="{{ URL::asset('uploads/dummy-profile.png') }}" class="img-radius wid-40" alt="{{$team->slug}}">
                                        @elseif($team->gender=='Female')
                                            <img src="{{ URL::asset('uploads/girl-profile-pic.png') }}" class="img-radius wid-40" alt="{{$team->slug}}">
                                        @else
                                            <img src="{{ URL::asset('uploads/dummy-profile.png') }}" class="img-radius wid-40" alt="{{$team->slug}}">
                                        @endif
                                    @endif
                                    </td>
                                    <td class="text-center">{{$team->name}}</td>
                                    <td class="text-center">{{$team->email}}</td>
                                    <td class="text-center">{{$team->mobile}}</td>
                                    <td class="text-center">{{$team->designation}}</td> 
                                    <td class="text-center">
                                        @if($team->status=='active')
                                            <span class="text-success">Active</span>
                                        @else 
                                            <span class="text-danger">Un active</span>
                                        @endif
                                    </td>                                                                     
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/teams/edit/'.encrypt($team->id)) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Edit</a>
                                        <a href="{{ URL::to('admin/teams/delete/'.encrypt($team->id)) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Trash</a>
                                    </td>
                                </tr> 
                                @php $i++; @endphp
                            @endforeach                             
                        </tbody>
                    </table>
                    {!! $teams->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection