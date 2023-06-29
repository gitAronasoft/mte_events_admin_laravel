<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use File;
use Session;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Request;
use App\Models\Order;
use App\Models\OrderItem;


class DashboardAnalystController extends Controller
{
    protected $guard = 'admin';

    public function totalOrder()
    {  
    	// $currentMonth = date('m');
        $orderList = Order::count();
        $completedOrder = Order::where('status', 'COMPLETED')->count();
        $totalSale = Order::sum('total_amount');
        $totalSaleMonth = Order::where('created_at', Carbon::now()->month)->sum('total_amount');
        $totalCustomers = User::count();
         $purchaseTickets = OrderItem::sum('purchase_tickets');
        $purchaseTicketsMonth = OrderItem::where('created_at', Carbon::now()->month)->sum('purchase_tickets');
        
        //dd($orderList);
        return view('admin.dashboard',compact('orderList', 'completedOrder',  'totalSale', 'totalSaleMonth' , 'totalCustomers', 'purchaseTickets',  'purchaseTicketsMonth'));
    }

    

}
?>