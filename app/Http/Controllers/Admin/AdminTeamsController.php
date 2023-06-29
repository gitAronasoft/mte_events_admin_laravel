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
use App\Models\Portfolio;
use App\Models\Team;

class AdminTeamsController extends Controller
{
    public function teams()
    {
        $teams = Team::orderby('id','DESC')->paginate(20);
        return view('admin.team.team-list',compact('teams'));
    }

    public function AddTeamMember()
    {
        return view('admin.team.add-team-member');
    }

    public function SaveTeamMember(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'name' => 'required', 
            'email' => 'required|unique:teams',
            'mobile' => 'required|unique:teams',
            'designation' => 'required',
            'image' => 'mimes:png,jpg,jpeg'                     		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $team = new Team;
        $team->name = $inputs['name'];
        $team->slug = Str::slug($inputs['name']);
        $team->email = $inputs['email']; 
        $team->mobile = $inputs['mobile']; 
        $team->address = $inputs['address'];
        $team->designation = $inputs['designation'];
        $team->gender = $inputs['gender'];
        if(!empty($inputs['image'])):                   
            $file= $inputs['image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/team_images/'), $filename);
            $team->image = asset('/uploads/team_images/'.$filename);
        endif;
        $team->status = 'active';
        $team->facebook_url = $inputs['facebook_url'];
        $team->twitter_url = $inputs['twitter_url'];
        $team->linkedin_url = $inputs['linkedin_url'];
        $team->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function EditTeamMember($id)
    {
        $memberDetail = Team::findOrFail(decrypt($id));
        return view('admin.team.edit-team-member',compact('memberDetail'));
    }

    public function updateTeamMember(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $memberDetail = Team::findOrFail(decrypt($inputs['id']));
        $rule=array(
            'name' => 'required', 
            'email' => 'required|unique:teams,email,'.$memberDetail->id, 
            'mobile' => 'required|unique:teams,mobile,'.$memberDetail->id, 
            'designation' => 'required',
            'image' => 'mimes:png,jpg,jpeg'                     		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        $memberDetail->name = $inputs['name'];
        $memberDetail->slug = Str::slug($inputs['name']);
        $memberDetail->email = $inputs['email']; 
        $memberDetail->mobile = $inputs['mobile']; 
        $memberDetail->address = $inputs['address'];
        $memberDetail->designation = $inputs['designation'];
        $memberDetail->gender = $inputs['gender'];
        if(!empty($inputs['image'])):
            if(!empty($memberDetail->image)) {
                $image_name = Str::afterLast($memberDetail->image, '/');
                if(File::exists(public_path('uploads/team_images/'.$image_name))):
                    File::delete(public_path('uploads/team_images/'.$image_name));
                endif;
            }                   
            $file= $inputs['image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/team_images/'), $filename);
            $memberDetail->image = asset('/uploads/team_images/'.$filename);
        endif;
        $memberDetail->status = $inputs['status'];
        $memberDetail->facebook_url = $inputs['facebook_url'];
        $memberDetail->twitter_url = $inputs['twitter_url'];
        $memberDetail->linkedin_url = $inputs['linkedin_url'];
        $memberDetail->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function deleteTeamMember($id)
    {
        $memberInfo = Team::findOrFail(decrypt($id));
        $memberInfo->delete();
        return redirect()->back()->with('success', 'Member trashed successfully.');
    }

    public function trashMembers()
    {
        $onlySoftDeleted = Team::onlyTrashed()->get();
        dd($onlySoftDeleted);
    }

}
