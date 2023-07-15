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
use App\Models\EventGallery;
use App\Models\Headervideo;
use App\Models\EventCategory;

class APIController extends Controller
{
    public $successStatus = 200;
    public function siteInfo()
    {
        $siteInfo = Setting::where('id',1)->get();
        return response()->json([
            'data' => $siteInfo
        ]);
    }

    public function services()
    {
        $sevicesList = Eventservice::where('status','publish')->orderBy('id','DESC')->get();
        return response()->json([
            'data' => $sevicesList
        ]);
    }

     public function serviceEvents($slug)
    {
        $eventsevicesList = Eventservice::with('EventByService')->where('status','publish')->where('slug',$slug)->get();
        return response()->json([
            'data' => $eventsevicesList
        ]);
    }

    public function eventslist()
    {
        $events = Event::where('status','publish')->where('expireAt', '>', strtotime('now'))->orderBy('id','DESC')->get();   
        return response()->json([
            'data' => $events
        ]);
    }

    public function eventsDetails($slug)
    {
        $eventDetail = Event::with(['servciesName','gallery'])->where('slug',$slug)->first();
        if($eventDetail->eventPurchased >= $eventDetail->eventTickets){
           $eventDetail['pendingTickets'] = 0;  
        }else{
            $eventDetail['pendingTickets'] = $eventDetail->eventTickets - $eventDetail->eventPurchased;  
        }
        return response()->json(['data'=>$eventDetail], $this->successStatus);
    }

    public function portfolios()
    {
        $portfolios = Portfolio::orderBy('id','DESC')->get();
        $imagesList = array();
        foreach($portfolios as $key=> $portfolio):
            $imagesList[$key] = $portfolio;
            if($portfolio->portfolios_type=='images'):
                $imagesList[$key]->album_images = unserialize($portfolio->portfolios_images);                
            endif;
        endforeach;
        return response()->json([
            'data' => $imagesList
        ]);
    }
    
    public function portfolioImageAlbumDetail($slug)
    {
        $ImageAlbumDetail = Portfolio::where('albumSlug',$slug)->first();
        if($ImageAlbumDetail):
            $ImageAlbumDetail['album_images'] = unserialize($ImageAlbumDetail->portfolios_images);
            return response()->json([
                'data' => $ImageAlbumDetail
            ]);
        else:
            return response()->json([
                'data' => ''
            ]);
        endif;
    }

    public function ourTeam()
    {
        $teams = Team::where('status','active')->orderby('id','DESC')->get();
        return response()->json([
            'data' => $teams
        ]);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('status',1)->orderBy('id','DESC')->get();
        return response()->json([
            'data' => $testimonials
        ]);
    }

    public function packages()
    {
        $packages_list = Package::orderBy('id','ASC')->get();
        $final_list = array();
        foreach($packages_list as $key=> $packages): 
            $final_list[$key] = $packages;          
            $final_list[$key]->features= PackageFeature::whereIn('id',unserialize($packages->features))->get();
        endforeach;        
        return response()->json([
            'data' => $final_list
        ]);
    }

    public function packageDetail($slug)
    {
        $packageDetail = Package::where('slug',$slug)->first();
        $packageDetails= PackageFeature::whereIn('id',unserialize($packageDetail->features))->get();        
        $packageDetail['features'] = $packageDetails;               
        return response()->json(['message' => 'success', 'data' => $packageDetail], $this->successStatus);
    }

    public function register(Request $request)
    {
        $input = Request::all();       
        $validator = Validator::make(Request::all(), [ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);           
        }        
        $six_digit_random_number = random_int(100000, 999999);
        
        $user = User::create( [                
            'name' => $input['name'], 
            'email' => $input['email'], 
            'verifycode'=>$six_digit_random_number,
            'password' => Hash::make($input['password'])
        ]);   
        
        $token = $user->createToken('authToken')->accessToken;
        /*************** Send Verifation Email ******************/
        $siteName = globalSetting('siteName');
        $siteEmail = globalSetting('siteEmail');
        $siteLogo = globalSetting('siteLogo');
        $SiteCopyRight = globalSetting('SiteCopyRight');
        $main_domain = env('MAIN_DOMAIN');
        $data = array(
            'siteName'=>$siteName,
            'siteEmail'=>$siteEmail,
            'siteLogo'=>$siteLogo,
            'SiteCopyRight'=>$SiteCopyRight,
            'name' => $user->name, 
            'email' => $user->email,
            'verifycode'=>$six_digit_random_number,
            'main_domain'=>$main_domain
        );
        Mail::send('emails.email-verification', $data, function ($message) use ($data) {
            $message->subject('Verification Code');
            $message->from($data['siteEmail'], $data['siteName']);         
            $message->to($data['email']);
        });
        /*************** End Send Verifation Email ******************/        
        return response()->json(['message' => 'success', 'data' => $token], $this->successStatus);         
    } 

    public function send_email($to,$to_name,$from,$from_name,$subject,$datas)
    {
         \Mail::send('email',['data1'=>$datas],function($message) use
             ($to,$to_name,$from,$from_name,$subject){
                 $message->to($to,$to_name)->subject($subject);
                 $message->from($from,$from_name);                     
         });        
    } 

    public function verifycode(Request $request){
        $input = Request::all();         
        $check = User::where('verifycode',$input['otp'])->count();
        if($check>0):
            $user = User::where('verifycode',$input['otp'])->first();
            $user->verifycode = '';
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->status = 'active';
            $user->save();
            return response()->json(['message' => 'success', 'data' => 'email verified'], $this->successStatus);            
        else:
            return response()->json(['message'=>'error','data'=>'invaild code'], 401);
        endif;        
    }

    public function login(Request $request)
    { 
        $validator = Validator::make(Request::all(), [ 
            'email' => 'required', 
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = Request::all();
        $checkEmail = User::where('email',$input['email'])->count();
        if($checkEmail>0):
            $check_user_active = User::where('email',$input['email'])->first();
            if($check_user_active->status=="active"):
                if(Auth::attempt(['email' => request('email'), 'password' => request('password')])):
                    $user = Auth::user();        
                    $token =  $user->createToken('authToken')->accessToken; 
                    return response()->json(['message' => 'success', 'data' => $token], $this->successStatus);           
                else: 
                    return response()->json(['message'=>'error','data'=>'Invalid email or password!'], 401); 
                endif;
            else:
                return response()->json(['message'=>'error','data'=>'Email verification invalid!'], 401);
            endif;
        else:
            return response()->json(['message'=>'error','data'=>'invalid email!'], 401);
        endif;
    }   
    
    public function eventenqueries(Request $request)
    {
        $validator = Validator::make(Request::all(),[
            'event' => 'required', 
            'fullName' => 'required',
            'email' => 'required|email',  
            'phone' => 'required|min:10',
            //'website' => 'required',
            //'company' => 'required',
            'dateevent' => 'required',
            'location' => 'required',
            'venue' => 'required',
            'guestCount' => 'required',
            //'eBudget' => 'required',
            'knowAbout' => 'required',
            //'otherInfo' => 'required'            
        ]);

        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);                      
        } 
        
        if(!empty($input['website'])):
            $website = $input['website'];
        else:
            $website = '';
        endif;
        
        if(!empty($input['company'])):
            $company = $input['company'];
        else:
            $company = '';
        endif;
        
        if(!empty($input['eBudget'])):
            $eBudget = $input['eBudget'];
        else:
            $eBudget = '';
        endif;
        
        if(!empty($input['otherInfo'])):
            $otherInfo = $input['otherInfo'];
        else:
            $otherInfo = '';
        endif;
    
        $input = Request::all();
        $data = Eventenquery::create( [                
            'event' => $input['event'], 
            'fullName' => $input['fullName'], 
            'email' => $input['email'], 
            'phone' => $input['phone'], 
            'website' => $website, 
            'company' => $company, 
            'dateevent' => $input['dateevent'], 
            'location' => $input['location'], 
            'venue' => $input['venue'], 
            'guestCount' => $input['guestCount'], 
            'eBudget' => $eBudget, 
            'knowAbout' => $input['knowAbout'], 
            'otherInfo' => $otherInfo            
        ]);     
        return response()->json(['message' => 'success', 'data' => 'Your query submitted successfully'], $this->successStatus);        
    }
    
    public function forgotPassword(Request $request)
    {
        $input = Request::all();       
        $validator = Validator::make(Request::all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);           
        }

        $checkEmail = User::where('email',$input['email'])->count();
        if($checkEmail>0):            
            $six_digit_random_number = random_int(100000, 999999);
            User::where('email',$input['email'])->update(['forgot_password_code'=>$six_digit_random_number]);
            $userDetail = User::where('email',$input['email'])->first();
            /*************** Send Verifation Email ******************/
                $siteName = globalSetting('siteName');
                $siteEmail = globalSetting('siteEmail');
                $siteLogo = globalSetting('siteLogo');
                $SiteCopyRight = globalSetting('SiteCopyRight');
                $main_domain = env('MAIN_DOMAIN');
                $data = array(
                    'siteName'=>$siteName,
                    'siteEmail'=>$siteEmail,
                    'siteLogo'=>$siteLogo,
                    'SiteCopyRight'=>$SiteCopyRight,
                    'name' => $userDetail->name,
                    'email' => $userDetail->email,
                    'verifycode'=>$six_digit_random_number,
                    'main_domain'=>$main_domain
                );
                Mail::send('emails.forgot-Password', $data, function ($message) use ($data) {
                    $message->subject('Forgot Password');
                    $message->from($data['siteEmail'], $data['siteName']);         
                    $message->to($data['email']);
                });
            /*************** End Send Verifation Email ******************/            
        endif;
        return response()->json(['message' => 'success', 'data' => "If your email is valid, you'll receive an email with instructions on how to reset your password"], 200);
    }
    
    public function resetPassword()
    {
        $input = Request::all();       
        $validator = Validator::make(Request::all(), [
            'otp' => 'required',
            'password' => 'required|required_with:confirm_password|same:confirm_password|min:8'
        ]);

        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);           
        }

        $checkEmail = User::where('forgot_password_code',$input['otp'])->count();
        if($checkEmail>0):
            User::where('forgot_password_code',$input['otp'])->update([
                'forgot_password_code'=>'',
                'password'=>Hash::make($input['password']),
            ]);
            return response()->json(['message' => 'success', 'data' =>'Password changed succssfully.'], 200);
        else:
            return response()->json(['message'=>'error','data'=>['otp'=>'Invalid OTP!']], 401);
        endif;
    }

    public function subscribe(Request $request)
    {
        $input = Request::all();
        $validator = Validator::make(Request::all(),[
            'fname' => 'required', 
            'lname' => 'required',
            'email' => 'required|email',               
        ]);

        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);                      
        }    

        $dc = 'us21';
        $list_id = 'c57469c5b0';
        $apiKey = '516a4ed9328b098e0123b632ebd78907-us21';       

        $url = "https://$dc.api.mailchimp.com/3.0/lists/".$list_id."/members";

        $data = array(
            'email_address' => $input['email'],            
            'status' => 'subscribed',
            'merge_fields' => array('FNAME'=> $input['fname'], 'LNAME'=>$input['lname'])  
        );

        $data_string = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "anystring:".$apiKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));
        $result = curl_exec($ch);
        if ($result === false) {
            return response()->json(['message'=>'error','data'=>curl_error($ch)], 401);  
        } 
        curl_close($ch);     
        return response()->json(['message' => 'success', 'data' => 'Subscribed successfully'], $this->successStatus);
    }
    
    public function contactUs(Request $request)
    {
        $input = Request::all();
        $validator = Validator::make(Request::all(),[
            // 'name' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',  
            'phone' => 'required',
            'message' => 'required',
            'companyJob' => 'required'           
        ]);

        if ($validator->fails()) { 
            return response()->json(['message'=>'error','data'=>$validator->errors()], 401);                      
        } 

        /*************** Send Email To Admin ******************/
            $siteName = globalSetting('siteName');
            $siteEmail = globalSetting('siteEmail');
            $siteLogo = globalSetting('siteLogo');
            $SiteCopyRight = globalSetting('SiteCopyRight');
            $main_domain = env('MAIN_DOMAIN');
            $data = array(
                'siteName'=>$siteName,
                'siteEmail'=>$siteEmail,
                'siteLogo'=>$siteLogo,
                'SiteCopyRight'=>$SiteCopyRight,
                'name' => $input['firstName']. "  " .$input['lastName'],
                'email' => $input['email'],
                'phone'=> $input['phone'],
                'messages'=> $input['message'],
                'companyJob'=> $input['companyJob'],
                'main_domain'=>$main_domain
            );
            Mail::send('emails.contact-us', $data, function ($message) use ($data) {
                $message->subject('Enquiry - '.$data['name']);
                $message->from($data['email']);         
                $message->to($data['siteEmail']);
            });
        /*************** End Send Verifation Email ******************/
        return response()->json(['message' => 'success', 'data' =>'Your Message Sent succssfully.'], 200);
    }
    
    public function headerVideos()
    {
        $Headervideos = Headervideo::where('status','active')->orderBy('id','DESC')->limit('1')->get();
        if($Headervideos):
            $videoUrls= array();
            foreach($Headervideos as $key=>$Headervideo):
                $videoUrls[$key] = $Headervideo; 
                $video_id = explode("?v=", $Headervideo->video_url); // For videos like http://www.youtube.com/watch?v=
                if(empty($video_id[1]))
                    $video_id = explode("/v/", $Headervideo->video_url); // For videos like http://www.youtube.com/watch/v/
                $video_id = explode("&", $video_id[1]); // Deleting any other params
                $video_id = $video_id[0];
                $videoUrls[$key]->youtube_video_id = $video_id;
            endforeach;                         
            return response()->json(['data' =>$videoUrls], 200);
        else:
            return response()->json(['data' =>''], 200);
        endif;
    }
    
    public function cartItem(Request $request)
    {
        $input = Request::all();

        $eventIds = [];
        foreach ($input as $event) {
            $eventIds[] = $event['id'];
        }
        
        $updatedEvents = [];
        $cartEvents = Event::whereIn('id',$eventIds)->get();
        
        foreach ($cartEvents as $event) {
            $eventKey = array_search($event['id'], array_column($input, 'id'));
            if (strtotime($event->updated_at) > strtotime($input[$eventKey]['updated_at'])) {
                $updatedEvents[] = $event;
            }
        }
        return response()->json(['events'=> $updatedEvents]);
    }
    
    // public function EventCategory()
    // {
    //     $EventCategory = EventCategory::where('CategoryStatus','active')->orderBy('id','ASC')->get();
    //     if(count($EventCategory)>0):
    //         $final_list = array();
    //         foreach($EventCategory as $key=> $catgory): //->whereRaw(FIND_IN_SET('css', Tags)) ->whereRaw('FIND_IN_SET(?, event_category_id)', [$catgory->id])
    //             $final_list[$key] = $catgory;
    //             $final_list[$key]->eventsList = Event::whereRaw('FIND_IN_SET(?, event_category_id)', [$catgory->id])->where('status','publish')->orderBy('id','ASC')->get();
    //         endforeach;
    //         return response()->json(['message' => 'success', 'data' => $final_list], $this->successStatus);
    //     else:
    //         return response()->json(['message'=>'error','data'=>'Data not found!'], 401);
    //     endif;
    // }
  
}
