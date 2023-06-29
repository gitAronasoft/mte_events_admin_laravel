@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Testimonials List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Testimonials List</a></li>
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
                        <h5>Testimonials List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/testimonials/add')}}" class="btn btn-success text-dark">Add Testimonials</a>
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
                                <th class="text-center">Client Name</th>
                                <th class="text-center">Testimonials</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($testimonials as $testimonial)                                                       
                                <tr>
                                    <td class="text-center">{{$i}}</td>                                    
                                    <td class="text-center">
                                    @if(!empty($testimonial->client_image))
                                        <img src="{{$testimonial->client_image}}" alt="{{$testimonial->client_name}}"  class="img-radius wid-40"/>
                                    @else
                                        <img src="{{ URL::asset('uploads/dummy-profile.png') }}" class="img-radius wid-40" alt="{{$testimonial->client_name}}">
                                    @endif
                                    </td>
                                    <td class="text-center">{{$testimonial->client_name}}</td>                                   
                                    <td class="text-center">
                                        {!! Str::of($testimonial->testimonials)->words(5, '...') !!}                                        
                                    </td>
                                    <td class="text-center">
                                        @if($testimonial->star_rating==1)
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @elseif($testimonial->star_rating==2)
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @elseif($testimonial->star_rating==3)
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @elseif($testimonial->star_rating==4)
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @elseif($testimonial->star_rating==5)
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                            <i class="fa fa-star" aria-hidden="true" style="color:#EEBD01;"></i>
                                        @else
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endif
                                        
                                    </td>
                                    <td class="text-center">
                                        @if($testimonial->status=='1')
                                            <span class="text-success">Active</span>
                                        @else 
                                            <span class="text-danger">Un active</span>
                                        @endif
                                    </td>                                                                     
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/testimonials/edit/'.encrypt($testimonial->id)) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Edit</a>
                                        <a href="{{ URL::to('admin/testimonials/delete/'.encrypt($testimonial->id)) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Trash</a>
                                    </td>
                                </tr> 
                                @php $i++; @endphp
                            @endforeach                             
                        </tbody>
                    </table>
                    {!! $testimonials->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection