@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Features List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Features List</a></li>
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
                        <h5>Features List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{URL::to('admin/packages/add-feature')}}" class="btn btn-success text-dark">Add New Feature</a>
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
                                <th class="text-center">Feature Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($features as $feature)                                                       
                                <tr>
                                    <td class="text-center">{{$i}}</td>
                                    <td class="text-center">{{$feature->feature_name}}</td>                                                                  
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/packages/features/edit/'.encrypt($feature->id)) }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Edit</a>
                                        <a href="{{ URL::to('admin/packages/features/delete/'.encrypt($feature->id)) }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Trash</a>
                                    </td>
                                </tr> 
                                @php $i++; @endphp
                            @endforeach                             
                        </tbody>
                    </table>
                    {!! $features->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection