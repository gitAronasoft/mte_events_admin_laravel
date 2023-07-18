<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

class AdminOrderController extends Controller
{
    protected $guard = 'admin';

    public function orders()
    {      
        $orders = OrderItem::with(['Orders'])->orderBy('id','DESC')->paginate(20);

        dd($orders);
        return view('admin.orders',compact('orders'));
    }    

}
