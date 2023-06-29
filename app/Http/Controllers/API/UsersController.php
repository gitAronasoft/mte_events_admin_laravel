<?php

namespace App\Http\Controllers\API;

use File;
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Request;
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
use App\Http\Controllers\Controller; 
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserWishlistEvent;
use App\Models\Subscription;
use App\Models\OrderItem;


class UsersController extends Controller
{
    public $successStatus = 200;
    
    public function logout(Request $request) 
    {
        if(Auth::user()){
            $user = Auth::user()->token();
            $user->revoke();    
            return response()->json([
              'success' => true,
              'message' => 'Logout successfully'
            ]);
        }else {
            return response()->json([
              'success' => false,
              'message' => 'Unable to Logout'
            ]);
        }        
    }

    public function profile()
    {        
        $userdetail = User::where('id',Auth::user()->id)->first();
        return response()->json(['data'=>$userdetail], $this->successStatus);        
    }

    public function profileUpdate(Request $request)
    {
        $input = Request::all();
        //dd($input);
        $validator = Validator::make(Request::all(),[            
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            //'phone' => 'required|unique:users,phone,'.Auth::user()->id,
            //'avatar' => 'mimes:png,jpeg',
            'password' => 'min:8'            
        ]);
       
        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);           
        } 

        $user = User::findOrFail(Auth::user()->id);
        //$user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        if(!empty($input['password'])):
            $user->password = Hash::make($input['password']);
        endif;
        if(!empty($input['avatar'])):
            if(!empty($user->profilePic)) {
                if(File::exists(public_path('uploads/users_profile_pics/'.$user->profilePic))):
                    File::delete(public_path('uploads/users_profile_pics/'.$user->profilePic));
                endif;
            }
            $file= $input['avatar'];
            $filename= Auth::user()->id.'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/users_profile_pics/'), $filename);
            $user->profilePic = asset('/uploads/users_profile_pics/'.$filename);
        endif; 
        $user->save();
        return response()->json(['message' => 'success','data'=>$input], $this->successStatus);
    }
    
    public function wishlistItems(Request $request)
    {
        $input = Request::all();
        $datasave = new UserWishlistEvent;
        $datasave->event_id = $input['eventID'];
        $datasave->user_id = Auth::user()->id;
        $datasave->save();             
        return response()->json(['message' => 'success', 'data' =>'Event saved successfully.'], $this->successStatus);  
    }

    public function wishlistRemove(Request $request)
    {

        $input = Request::all();
        UserWishlistEvent::where('user_id',Auth::user()->id)->where('event_id', $input['eventID'])->delete();
        return response()->json(['message' => 'success', 'data' =>'Wishlist event remove successfully.'], $this->successStatus);
    }

    public function wishlist()
    {
        $userWishlistID = UserWishlistEvent::where('user_id',Auth::user()->id)->get();
        $event_ids = array();
        foreach($userWishlistID as $key=> $value):
            $event_ids[$key] = $value->event_id; 
        endforeach;
        $eventWishList = Event::whereIn('id',$event_ids)->get();
        return response()->json(['message' => 'success', 'data' => $eventWishList], $this->successStatus);        
    }

    public function subscriptions(Request $request)
    {        
        $subscriptions = Subscription::with(['packages'])->where('user_id',Auth::user()->id)->orderby('id','DESC')->get();
        $final_list = array();
        foreach($subscriptions as $key=> $subscription): 
            // $endOn = Carbon::parse($subscription->created_at)->addDay(30);
            // $timeNow = Carbon::now();
            $endOn = date('Y-m-d', strtotime('+30 days '. $subscription->created_at));
            $timeNow = date('Y-m-d');
            $dateExpire = date_create($endOn);
            $dateNow = date_create($timeNow);
            $interval = date_diff($dateExpire, $dateNow);           
            if($timeNow >= $endOn){
                $status = true;
                $remaining_days = 0;
            }else{
                $remaining_days = abs($interval->format('%R%a'));
                $status = false;
            }
            $final_list[$key] = $subscription;    
            $final_list[$key]->remaining_days = $remaining_days;     
            $final_list[$key]->package_expire = $status;
            $final_list[$key]->progress_width = round(($remaining_days / 30) * 100);
            $final_list[$key]->packages->featureList = PackageFeature::whereIn('id',unserialize($subscription->packages->features))->get();
        endforeach;        
        return response()->json([
            'data' => $final_list
        ]); 
    }

    public function bookedEvents(Request $request)
    {        
        $events = OrderItem::with(['Orders', 'Events'])
                            ->whereHas('Orders', function ($query) {
                                $query->where('user_id', Auth::user()->id);                                
                            })->orderby('id','DESC')->get();
                            
        return response()->json([
            'data' => $events
        ]);      
    }

    public function orderTickets(Request $request)
    {        
        $input = Request::all();

        $events = OrderItem::with(['Orders', 'Events'])
                            ->whereHas('Orders', function ($query) use ($input) {
                                $query->where('user_id', Auth::user()->id);   
                                $query->where('order_id', $input['order_id']); // Add condition for order ID                             
                            })->orderby('id','DESC')->get();
                            
        return response()->json([
            'data' =>$events 
        ]);      
    }

}
