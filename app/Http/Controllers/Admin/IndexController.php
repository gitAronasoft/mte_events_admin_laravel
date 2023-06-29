<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class IndexController extends Controller
{
    protected $guard = 'admin';

    public function homePage()
    {
        if(Auth::check()):
            $role = auth()->user()->role;
            if($role=='admin'):
                return redirect('admin/dashboard');
            else :
                return redirect('/admin');
            endif;
        else :
            return redirect('/admin');
        endif;
    }

    public function login()
    {
        if(Auth::check()):
            $role = auth()->user()->role;
            if($role=='admin'):
                return redirect('admin/dashboard');
            else :
                return redirect('/');
            endif;
        else :
            return view('admin.login');
        endif;
    }

    public function adminLogin(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'email' => 'required', 
            'password' => 'required'                      		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 
        if (Auth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) 
        {   
            return redirect('admin/dashboard');
        } elseif (Auth::attempt(['username' => $inputs['email'], 'password' => $inputs['password']])) 
        {   
            return redirect('admin/dashboard');
        }
         else {
            return redirect('/admin')->withErrors('invalid detail. Please try again.');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin');
    }

    public function dashboard()
    { 
        return view('admin.dashboard');           
    }

    public function generalSetting()
    {
        $setting = Setting::where('id',1)->first();        
        return view('admin.setting',compact('setting'));
    }

    public function SaveGeneralSetting(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'siteName' => 'required', 
            'SiteSupportNumber' => 'required',
            'siteEmail' => 'required',
            'SiteCopyRight' => 'required',
            'siteLogo' => 'mimes:png,jpg,jpeg',
            'siteFavicon' => 'mimes:png,jpg,jpeg'                    		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        $count = Setting::count();
        if($count>0):
           $setting = Setting::findOrFail(1);
        else:
            $setting = new Setting;
        endif;
        $setting->siteName = $inputs['siteName'];
        $setting->SiteSupportNumber = $inputs['SiteSupportNumber'];
        $setting->siteEmail = $inputs['siteEmail'];
        $setting->SiteCopyRight = $inputs['SiteCopyRight'];
        $setting->FacebookLink = $inputs['FacebookLink'];
        $setting->TwitterLink = $inputs['TwitterLink'];
        $setting->LinkedinLink = $inputs['LinkedinLink'];
        $setting->InstagramLink = $inputs['InstagramLink'];
        if(!empty($inputs['siteLogo'])):
            if(!empty($setting->siteLogo)) {
                $siteLogo = Str::afterLast($setting->siteLogo, '/');
                if(File::exists(public_path('uploads/'.$siteLogo))):
                    File::delete(public_path('uploads/'.$siteLogo));
                endif;
            }
            $file= $inputs['siteLogo'];
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('uploads/'), $filename);
            $setting->siteLogo = asset('uploads/'.$filename);
        endif;
        if(!empty($inputs['siteFavicon'])):
            if(!empty($setting->siteFavicon)) {
                $siteFavicon = Str::afterLast($setting->siteFavicon, '/');
                if(File::exists(public_path('uploads/'.$siteFavicon))):
                    File::delete(public_path('uploads/'.$siteFavicon));
                endif;
            }
            $file= $inputs['siteFavicon'];
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('uploads/'), $filename);
            $setting->siteFavicon = asset('uploads/'.$filename);;
        endif;
        $setting->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id                   		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $adminDetail = User::where('id',Auth::user()->id)->where('role','admin')->first();
        $adminDetail->name = $inputs['name'];
        $adminDetail->email = $inputs['email'];
        $adminDetail->password = Hash::make($inputs['password']);
        if(!empty($inputs['profilePic'])):
            if(!empty($adminDetail->profilePic)) {
                if(File::exists(public_path('uploads/users_profile_pics/'.$adminDetail->profilePic))):
                    File::delete(public_path('uploads/users_profile_pics/'.$adminDetail->profilePic));
                endif;
            }
            $file= $inputs['profilePic'];
            $filename= Auth::user()->id.'_'.$file->getClientOriginalName();
            $file-> move(public_path('uploads/users_profile_pics/'), $filename);
            $adminDetail->profilePic = $filename;
        endif;        
        $adminDetail->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

}
