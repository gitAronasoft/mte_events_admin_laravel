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
use App\Models\Testimonial;
use URL;

class AdminTestimonialsController extends Controller
{
    public function testimonials()
    {
        $testimonials = Testimonial::orderby('id','DESC')->paginate(20);
        return view('admin.testimonial.testimonial-list',compact('testimonials'));
    }

    public function addTestimonial()
    {
        return view('admin.testimonial.add-testimonial');
    }

    public function saveTestimonial(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'client_name' => 'required', 
            'testimonials' => 'required',
            'client_image' => 'mimes:png,jpg,jpeg',
            'feature_image' => 'mimes:png,jpg,jpeg'                     		        	        
        );        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $testimonial = new Testimonial;
        $testimonial->client_name = $inputs['client_name'];
        $testimonial->testimonials = $inputs['testimonials'];
        $testimonial->star_rating = $inputs['star_rating'];
        $testimonial->status = $inputs['status'];
        if(!empty($inputs['client_image'])):                   
            $file= $inputs['client_image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials/'), $filename);
            $testimonial->client_image = asset('/uploads/testimonials/'.$filename);
        endif;
        if(!empty($inputs['feature_image'])):                   
            $file= $inputs['feature_image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials/'), $filename);
            $testimonial->feature_image = asset('/uploads/testimonials/'.$filename);
        endif;
        $testimonial->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function EditTestimonial($id)
    {
        $testimonialDetail = Testimonial::findOrFail(decrypt($id));
        return view('admin.testimonial.edit-testimonial',compact('testimonialDetail'));
    }

    public function updateTestimonial(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();        
        $rule=array(
            'client_name' => 'required', 
            'testimonials' => 'required',
            'client_image' => 'mimes:png,jpg,jpeg',
            'feature_image' => 'mimes:png,jpg,jpeg'                     		        	        
        );        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $testimonialInfo = Testimonial::findOrFail(decrypt($inputs['id']));
        $testimonialInfo->client_name = $inputs['client_name'];
        $testimonialInfo->testimonials = $inputs['testimonials'];
        $testimonialInfo->star_rating = $inputs['star_rating'];
        $testimonialInfo->status = $inputs['status'];
        if(!empty($inputs['client_image'])):
            if(!empty($testimonialInfo->client_image)) {
                $client_image_name = Str::afterLast($testimonialInfo->client_image, '/');                
                if(File::exists(public_path('uploads/testimonials/'.$client_image_name))):
                    File::delete(public_path('uploads/testimonials/'.$client_image_name));
                endif;
            }                    
            $file= $inputs['client_image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials/'), $filename);
            $testimonialInfo->client_image = asset('/uploads/testimonials/'.$filename);
        endif;
        if(!empty($inputs['feature_image'])): 
            if(!empty($testimonialInfo->feature_image)) {
                $feature_image_name = Str::afterLast($testimonialInfo->client_image, '/');
                if(File::exists(public_path('uploads/testimonials/'.$feature_image_name))):
                    File::delete(public_path('uploads/testimonials/'.$feature_image_name));
                endif;
            }                   
            $file= $inputs['feature_image'];
            $filename= rand().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials/'), $filename);
            $testimonialInfo->feature_image = asset('/uploads/testimonials/'.$filename);
        endif;
        $testimonialInfo->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail(decrypt($id));
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonial Trashed Successfully.');
    }

}
