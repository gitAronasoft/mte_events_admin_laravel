@extends('admin.layouts.adminApp')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Video Album List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Video Album List</a></li>
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
                        <h5 style="margin-top:17px;">Video Album List</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="" class="btn btn-success text-dark"><i class="fa fa-plus"></i> Add New Album</a>
                    </div>
                </div>             
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th> 
                                <th class="text-center">Feature Image</th>                              
                                <th class="text-center">Ablum Name</th>
                                <th class="text-center">Total Videos</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"></th>
                                <td class="text-center"></td>                               
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th> 
                                <th class="text-center">Feature Image</th>                              
                                <th class="text-center">Ablum Name</th>
                                <th class="text-center">Total Videos</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>                
            </div>
        </div>
    </div>
@endsection

@push('scripts')    

@endpush('scripts')