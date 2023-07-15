<?php

namespace App\Http\Controllers\API;

use File;
use Session;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Setting;
use App\Models\Event;
use App\Models\Eventservice;
use App\Models\Portfolio;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Package;
use App\Models\PackageFeature;
use App\Models\Eventenquery;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\EventGallery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscription;

class PurchaseController extends Controller
{
    
    public function orders(Request $request)
    {
        $input = Request::all();  
        $subscriptions = Subscription::with(['packages'])->where('package_id',$input['package_id'])->orderby('id','DESC')->first();
        $siteName = globalSetting('siteName');
        $siteEmail = globalSetting('siteEmail');
        $siteLogo = globalSetting('siteLogo');
        $SiteCopyRight = globalSetting('SiteCopyRight');
        $main_domain = env('MAIN_DOMAIN');
        $emailData = array(
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail,
            'siteLogo'=>$siteLogo,
            'SiteCopyRight'=>$SiteCopyRight,
            'main_domain'=>$main_domain,
            'subscriptions'=>$subscriptions
        );
        Mail::send('emails.package-receipt', $emailData, function ($message) use ($emailData) {
            $message->subject('payment receipt ');
            $message->from('info@moneytrainevents.com');         
            $message->to('manjeet@aronasoft.com');
        });
        
    }
    
    public function purchaseTickets(Request $request)
    {        
        $returnOutput = array();
        $input = Request::all();  
        if(Auth::check() && Auth::User()->role=='user'):
        	$email = Auth::user()->email;	        
	    else:
	    	if(empty($input['name'])):
	            return response()->json(['message'=>'error','data'=>['name'=>'Name field required.']], 401);
	        endif;
	        $checkEmail = User::where('email',$input['email'])->count();
	        if($checkEmail>0):
	            return response()->json(['message'=>'error','data'=>['email'=>'Email address already exit.']], 401);
	        endif;
	        $email = $input['email'];
	    endif;
       
        //paymnet setup here   
        //$url = env('SQUARE_PRODUCTION_ENDPOINT');
        $url = env('SQUARE_SANDBOX_ENDPOINT');
        $headers = array(
            'Square-Version: 2023-05-17',
            //'Authorization: Bearer '.env('SQUARE_PRODUCTION_TOKEN'),
            'Authorization: Bearer '.env('SQUARE_SANDBOX_TOKEN'),
            'Content-Type: application/json'
        );        
        $data = array(
            'idempotency_key' => uniqid(),
            'source_id' => $input['sourceId'],
            'autocomplete' => true,
            'buyer_email_address' => $email,
            "amount_money" => [
              "amount"=> $input['total_amount']*100,
              "currency"=> "USD"
            ],
            'verification_token'=>$input['verify_token']
        );
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));        
        $response = curl_exec($curl);  
        
        if ($response === false) {
            $error = curl_error($curl);
            return response()->json(['message' => 'error', 'data' => ['payment'=>$error]], 401);
            // Handle the error accordingly
        }        
        curl_close($curl);
        $paymentJson = json_decode($response);
        if(isset($paymentJson->errors)){
            return response()->json(['message' => 'error', 'data' => ['payment'=>$paymentJson->errors[0]->detail]], 401);
        }
        
        //order setup here
       
        if($paymentJson->payment->status=='COMPLETED'):
        	if(Auth::check() && Auth::User()->role=='user'):
        		$userDetail = User::where('email',Auth::user()->email)->first();      	
	        else:
	        	$password = random_int(10000000,99999999);
	            $saveUser = new User;
	            $saveUser->role = 'user';
	            $saveUser->name = $input['name'];
	            $saveUser->email = $input['email'];
	            $saveUser->password = Hash::make($password);
	            $saveUser->gender = $input['gender'];
	            $saveUser->acceptTerms = $input['acceptTerms'];
	            $saveUser->sendMeNoti = $input['sendMeNoti'];
	            $saveUser->status = 'active';
	            $saveUser->save();
	            $userDetail = User::where('email',$saveUser->email)->first();
	        endif;            
            
            $returnOutput['order_id'] = $paymentJson->payment->order_id;

            $order = new Order;
            $order->user_id = $userDetail->id;
            $order->location_id = $paymentJson->payment->location_id;
            $order->order_id = $paymentJson->payment->order_id;
            $order->payment_id = $paymentJson->payment->id;
            $order->total_amount = $paymentJson->payment->total_money->amount/100;
            $order->currency = $paymentJson->payment->total_money->currency;
            $order->status = $paymentJson->payment->status;
            $order->save();

            $orderItems = $input['events'];

            foreach($orderItems as $key=>$orderItem):
                $saveItems = new OrderItem;
                $saveItems->order_id = $order['id'];
                $saveItems->event_id = $orderItem['id'];
                $saveItems->ticket_id = 'TK-'.$orderItem['id'].'-'.random_int(100000,999999);
                $saveItems->purchase_tickets = (int)$orderItem['ticketInQueue'];
                $saveItems->save();
                $lastEventPurchased = Event::where('id',$orderItem['id'])->first();
                Event::where('id', $orderItem['id'])->update(['eventPurchased'=>$lastEventPurchased->eventPurchased + $saveItems->purchase_tickets]);
            endforeach;
            
            /*************** Send Email ******************/
            $orders = Order::where('id', $order->id)->with('orderItems')->get();
            $siteName = globalSetting('siteName');
            $siteEmail = globalSetting('siteEmail');
            $siteLogo = globalSetting('siteLogo');
            $SiteCopyRight = globalSetting('SiteCopyRight');
            $main_domain = env('MAIN_DOMAIN');
            if(Auth::check() && Auth::User()->role=='user'):
            else:
                $emailData = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'siteLogo'=>$siteLogo,
                'SiteCopyRight'=>$SiteCopyRight,
                'name' => $userDetail->name, 
                'email' => $userDetail->email,
                'password'=>$password,
                'main_domain'=>$main_domain
                );
                Mail::send('emails.Welcome-email', $emailData, function ($message) use ($emailData) {
                    $message->subject('Welcome '. $emailData['siteName']);
                    $message->from($emailData['siteEmail'], $emailData['siteName']);         
                    $message->to($emailData['email']);
                });
               
                if(Auth::attempt(['email' => $input['email'], 'password' => $password])):
                    $user = Auth::user();        
                    $token =  $user->createToken('authToken')->accessToken; 
                    $returnOutput['token'] = $token;         
                endif; 
            endif;
            // send email receipt   
                $eventReceipt = array(
                    'siteName'=>$siteName,
                    'siteEmail'=>$siteEmail,
                    'siteLogo'=>$siteLogo,
                    'SiteCopyRight'=>$SiteCopyRight,
                    'name' => $userDetail->name, 
                    'email' => $userDetail->email,
                    'password'=>$password,
                    'main_domain'=>$main_domain,
                    'orders'=>$orders
                );
             
                Mail::send('emails.receipt', $eventReceipt, function ($message) use ($eventReceipt) {
                    $message->subject('payment receipt '. $eventReceipt['siteName']);
                    $message->from($eventReceipt['siteEmail']);         
                    $message->to($eventReceipt['email']);
                });
            // End send email receipt

            /*************** End Send Email ******************/
            return response()->json(['message' => 'success', 'data' => $returnOutput], 200);
        endif;
        return response()->json(['message' => 'error', 'data' => ['payment' => $paymentJson->errors[0]->detail]], 401);
    }

    public function purchasePackage(Request $request)
    {
        $returnOutput = array();
        $input = Request::all(); 
        if(Auth::check() && Auth::User()->role=='user'):
            $email = Auth::user()->email;           
        else:
            if(empty($input['name'])):
                return response()->json(['message'=>'error','data'=>['name'=>'Name field required.']], 401);
            endif;
            $checkEmail = User::where('email',$input['email'])->count();
            if($checkEmail>0):
                return response()->json(['message'=>'error','data'=>['email'=>'Email address already exit.']], 401);
            endif;
            $email = $input['email'];
        endif;
       
        //paymnet setup here   
        //$url = env('SQUARE_PRODUCTION_ENDPOINT');
        $url = env('SQUARE_SANDBOX_ENDPOINT');
        $headers = array(
            'Square-Version: 2023-05-17',
            //'Authorization: Bearer '.env('SQUARE_PRODUCTION_TOKEN'),
            'Authorization: Bearer '.env('SQUARE_SANDBOX_TOKEN'),
            'Content-Type: application/json'
        );        
        $data = array(
            'idempotency_key' => uniqid(),
            'source_id' => $input['sourceId'],
            'autocomplete' => true,
            'buyer_email_address' => $email,
            "amount_money" => [
              "amount"=> $input['total_amount']*100,
              "currency"=> "USD"
            ],
            'verification_token'=>$input['verify_token']
        );
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));        
        $response = curl_exec($curl);  
        
        if ($response === false) {
            $error = curl_error($curl);
            return response()->json(['message' => 'error', 'data' => ['payment'=>$error]], 401);
            // Handle the error accordingly
        }        
        curl_close($curl);
        $paymentJson = json_decode($response); 
        if(isset($paymentJson->errors)){
            return response()->json(['message' => 'error', 'data' => ['payment'=>$paymentJson->errors[0]->detail]], 401);
        }
           
        //Subscription setup here
        
        if($paymentJson->payment->status=='COMPLETED'):
            if(Auth::check() && Auth::User()->role=='user'):
                $userDetail = User::where('email',Auth::user()->email)->first();        
            else:
                $password = random_int(10000000,99999999);
                $saveUser = new User;
                $saveUser->role = 'user';
                $saveUser->name = $input['name'];
                $saveUser->email = $input['email'];
                $saveUser->gender = $input['gender'];
	            $saveUser->acceptTerms = $input['acceptTerms'];
	            $saveUser->sendMeNoti = $input['sendMeNoti'];
                $saveUser->password = Hash::make($password);
                $saveUser->status = 'active';
                $saveUser->save();
                $userDetail = User::where('email',$saveUser->email)->first();
            endif;            
            
            $subscription = new Subscription;
            $subscription->user_id = $userDetail->id;           
            $subscription->order_id = $paymentJson->payment->order_id;
            $subscription->package_id = $input['package'];            
            $subscription->payment_id = $paymentJson->payment->id;
            $subscription->total_amount = $paymentJson->payment->total_money->amount/100;
            $subscription->currency = $paymentJson->payment->total_money->currency;
            $subscription->status = $paymentJson->payment->status;
            $subscription->save();
            
            $subscriptions = Subscription::with(['packages'])->where('package_id',$subscription->package_id)->first();
            
            /*************** Send Email ******************/
            $siteName = globalSetting('siteName');
            $siteEmail = globalSetting('siteEmail');
            $siteLogo = globalSetting('siteLogo');
            $SiteCopyRight = globalSetting('SiteCopyRight');
            $main_domain = env('MAIN_DOMAIN');
            
            if(Auth::check() && Auth::User()->role=='user'):
            else:
                $emailData2 = array(
                    'siteName'=>$siteName,
                    'siteEmail'=>$siteEmail,
                    'siteLogo'=>$siteLogo,
                    'SiteCopyRight'=>$SiteCopyRight,
                    'name' => $userDetail->name, 
                    'email' => $userDetail->email,
                    'password'=>$password,
                    'main_domain'=>$main_domain,
                    'subscriptions'=>$subscriptions
                );
                Mail::send('emails.Welcome-email', $emailData2, function ($message) use ($emailData2) {
                    $message->subject('Welcome '. $emailData2['siteName']);
                    $message->from($emailData2['siteEmail'], $emailData2['siteName']);         
                    $message->to($emailData2['email']);
                });
                
                if(Auth::attempt(['email' => $input['email'], 'password' => $password])):
                    $user = Auth::user();        
                    $token =  $user->createToken('authToken')->accessToken; 
                    $returnOutput['token'] = $token;          
                endif;
            endif;
            // package receipt email
                $packageReceipt = array(
                    'siteName'=>$siteName,
                    'siteEmail'=>$siteEmail,
                    'siteLogo'=>$siteLogo,
                    'SiteCopyRight'=>$SiteCopyRight,
                    'name' => $userDetail->name, 
                    'email' => $userDetail->email,
                    'password'=>$password,
                    'main_domain'=>$main_domain,
                    'subscriptions'=>$subscriptions
                );
                Mail::send('emails.package-receipt', $packageReceipt, function ($message) use ($packageReceipt) {
                    $message->subject('payment receipt'. $packageReceipt['siteName']);
                    $message->from('info@moneytrainevents.com',$packageReceipt['siteName']);         
                    $message->to($packageReceipt['email']);
                });
            // package receipt email
            /*************** End Send Email ******************/
            return response()->json(['message' => 'success', 'data' => $returnOutput], 200);
        endif;
        return response()->json(['message' => 'error', 'data' => ['payment' => $paymentJson->errors[0]->detail]], 401);
    }

}
