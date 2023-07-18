@extends('admin.layouts.adminApp')

@section('content')

    <div class="page-header">

        <div class="page-block">

            <div class="row align-items-center">

                <div class="col-md-12">

                    <div class="page-header-title">

                        <h5 class="m-b-10">Orders List</h5>

                    </div>

                    <ul class="breadcrumb">

                        <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}"><i class="feather icon-home"></i></a></li>

                        <li class="breadcrumb-item"><a href="#!">Orders List</a></li>

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

                        <h5>Orders List</h5>
                        
                    </div>

                </div>             

            </div>

            <div class="card-body table-border-style">

                <div class="table-responsive">

                    <table class="table table-striped">

                        <thead>

                            <tr>

                                <th class="text-center">#</th>

                                <th class="text-center">Order Id</th>

                                <th class="text-center">Transaction Id</th>

                                <th class="text-center">Customer Info</th>

                                <th class="text-center">Event Name</th>

                                <th class="text-center">Event On</th>

                                <th class="text-center">No. Of Ticket</th>

                                <th class="text-center">Paid Amount</th>

                                <th class="text-center">Status</th>

                                <th class="text-center">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @php $i = 1; @endphp

                            @foreach($orders as $order)


                                <tr>

                                    <td class="text-center">{{$i}}</td>

                                    <td class="text-center">{{$order->Orders->order_id}} </td>

                                    <td class="text-center">{{$order->Orders->payment_id}} </td>

                                    <td class="text-center">
                                        <p>{{$order->purchase_event_detail->eventDate}}</p>  
                                        <p>{{$order->purchase_event_detail->eventTime}}</p>
                                    </td>

                                    <td class="text-center">{{$order->purchase_event_detail->title}}</td>

                                    <td class="text-center">
                                        <p>{{$order->purchase_event_detail->eventDate}}</p>  
                                        <p>{{$order->purchase_event_detail->eventTime}}</p>
                                    </td>

                                    <td class="text-center">{{$order->purchase_tickets}}</td>

                                    <td class="text-center">

                                        <p>{{$order->Orders->total_amount}}</p>

                                    </td>
                                                                    

                                    <td class="text-center">

                                        <a href="{{ URL::to('admin/event/edit/') }}" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Edit</a>

                                    </td>

                                </tr>

                                @php $i++; @endphp

                            @endforeach

                        </tbody>

                    </table>

                    {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!}

                </div>

            </div>

        </div>

    </div>

@endsection