@extends('admin.layouts.adminApp')
@section('content')
<div class="row">
            <!-- order-card start -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-body">
                        <h6 class="text-white">Orders Received</h6>
                        <h2 class="text-right text-white"><i class="feather icon-shopping-cart float-left"></i><span>{{$orderList}}</span></h2>
                        <p class="m-b-0">Completed Orders<span class="float-right">{{$completedOrder}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-body">
                        <h6 class="text-white">Total Sales</h6>
                        <h2 class="text-right text-white"><i class="feather icon-tag float-left"></i><span>{{$totalSale}}</span></h2>
                        <p class="m-b-0">This Month<span class="float-right">{{$totalSaleMonth}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h6 class="text-white">Purchase Tickets</h6>
                        <h2 class="text-right text-white"><i class="feather icon-repeat float-left"></i><span>{{$purchaseTickets}}</span></h2>
                        <p class="m-b-0">This Month<span class="float-right">{{$purchaseTicketsMonth}}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-body">
                        <h6 class="text-white">Total Profit</h6>
                        <h2 class="text-right text-white"><i class="feather icon-award float-left"></i><span>$9,562</span></h2>
                        <p class="m-b-0">This Month<span class="float-right">$542</span></p>
                    </div>
                </div>
            </div>
            <!-- order-card end -->
            <!-- users visite start -->
            <div class="col-md-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Unique Visitor</h5>
                    </div>
                    <div class="card-body pl-0 pb-0">
                        <div id="unique-visitor-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-6">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body bg-patern">
                                <div class="row">
                                    <div class="col-auto">
                                        <span>Customers</span>
                                    </div>
                                    <div class="col text-right">
                                        <h2 class="mb-0">{{$totalCustomers}}</h2>
                                        <span class="text-c-green">8.2%<i class="feather icon-trending-up ml-1"></i></span>
                                    </div>
                                </div>
                                <div id="customer-chart"></div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h3 class="m-0"><i class="fas fa-circle f-10 m-r-5 text-success"></i>674</h3>
                                        <span class="ml-3">New</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-0"><i class="fas fa-circle text-primary f-10 m-r-5"></i>182</h3>
                                        <span class="ml-3">Return</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card bg-primary text-white">
                            <div class="card-body bg-patern-white">
                                <div class="row">
                                    <div class="col-auto">
                                        <span>Customers</span>
                                    </div>
                                    <div class="col text-right">
                                        <h2 class="mb-0 text-white">826</h2>
                                        <span class="text-white">8.2%<i class="feather icon-trending-up ml-1"></i></span>
                                    </div>
                                </div>
                                <div id="customer-chart1"></div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <h3 class="m-0 text-white"><i class="fas fa-circle f-10 m-r-5 text-success"></i>674</h3>
                                        <span class="ml-3">New</span>
                                    </div>
                                    <div class="col">
                                        <h3 class="m-0 text-white"><i class="fas fa-circle f-10 m-r-5 text-white"></i>182</h3>
                                        <span class="ml-3">Return</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- users visite end -->
        </div>
@endsection