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
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use App\Models\Event;
use App\Models\Eventservice;
use App\Models\EventGallery;
use App\Models\Eventenquery;
use App\Models\EventCategory;

class AdminEventController extends Controller
{
    protected $guard = 'admin';

    public function eventList()
    {
        $eventList = Event::with(['servciesName','gallery'])->orderBy('id','DESC')->paginate(20); 
        return view('admin.events.event-list',compact('eventList'));
    }

    public function eventAdd()
    {
        $eventsevicesList = Eventservice::where('status','publish')->orderBy('id','DESC')->get();
        $categories = EventCategory::where('CategoryStatus','active')->orderBy('id','ASC')->get();
        return view('admin.events.add-event',compact('eventsevicesList','categories'));
    }

    public function eventSave(Request $request)
    {
        $data =  Request::except(array('_token'));  
         
        $inputs = Request::all();
        $dateFormat = str_replace("/", "-", $inputs['eventDate']);
        $expire_at = strtotime($dateFormat.' '.$inputs['eventTime']);        
     
        $rule=array(
            'title' => 'required', 
            'eventService' => 'required',
            'category' => 'required',
            'eventLocation' => 'required',
            'eventTickets' => 'required',
            'eventDate' => 'required',
            'eventTime' => 'required',
            'decription' => 'required',
            'featureImage' => 'mimes:png,jpg,jpeg'                     		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $count = Event::where('title',$inputs['title'])->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['title'].' already exit.');
        endif;

        $event = new Event;
        $event->eventService = $inputs['eventService'];
        $event->event_category_id = implode(',',$inputs['category']);
        $event->title = $inputs['title'];
        $event->slug = Str::slug($inputs['title']);
        $event->decription = $inputs['decription'];
        $event->eventTicketsPrice = $inputs['eventTicketsPrice'];
        $event->eventLocation = $inputs['eventLocation'];
        $event->latitude = $inputs['latitude'];
        $event->longitude = $inputs['longitude'];
        $event->eventTickets = $inputs['eventTickets'];
        $event->eventDate = $inputs['eventDate'];
        $event->eventTime = $inputs['eventTime'];
        $event->expireAt = $expire_at;
        $event->status = $inputs['status'];
        if(!empty($inputs['featureImage'])):                   
            $file= $inputs['featureImage'];
            $filename= Str::slug($inputs['title']).'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/event_images/'), $filename);
            $event->featureImage = asset('/uploads/event_images/'.$filename);
        endif;        
        $event->save();

        if(!empty($inputs['GalleryImages'])):
            foreach($inputs['GalleryImages'] as $key=> $images): 
                $GalleryImages = new EventGallery;  
                $GalleryImages->event_id = $event->id;        
                $file= $images;
                $filename= rand().'-'.$file->getClientOriginalName();
                $file->move(public_path('uploads/event_gallery/'), $filename);
                $GalleryImages->event_gallery_images = asset('/uploads/event_gallery/'.$filename);
                $GalleryImages->save();
            endforeach;            
        endif;

        return redirect()->back()->with('success', 'Save successfully.');        
    }

    public function editEvent($slug)
    {
        $CheckEvent = Event::where('slug',$slug)->count();
        if($CheckEvent>0):
            $eventDetail = Event::where('slug',$slug)->first();
            $eventGallery = EventGallery::where('event_id',$eventDetail->id)->orderBy('id','DESC')->get();
            $eventsevicesList = Eventservice::where('status','publish')->orderBy('id','DESC')->get();
            $categories = EventCategory::where('CategoryStatus','active')->orderBy('id','ASC')->get();
            return view('admin.events.edit-event',compact('eventDetail','eventGallery','eventsevicesList','categories'));
        else:
            return redirect('admin/event/list');
        endif; 
    }

    public function UpdateEvent(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $dateFormat = str_replace("/", "-", $inputs['eventDate']);
        $expire_at = strtotime($dateFormat.' '.$inputs['eventTime']);   
        $rule=array(
            'title' => 'required', 
            'eventService' => 'required',
            'eventLocation' => 'required',
            'eventTickets' => 'required',
            'eventDate' => 'required',
            'eventTime' => 'required',
            'decription' => 'required',
            'featureImage' => 'mimes:png,jpg,jpeg'                      		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $eventDetail = Event::where('id',decrypt($inputs['id']))->first();
        $count = Event::where('title',$inputs['title'])->count();
        if($count>0 && $eventDetail->title!=$inputs['title']):
            return redirect()->back()->withErrors($inputs['title'].' already exit.');
        endif;
        
        $eventUpdate = Event::where('id',decrypt($inputs['id']))->first();
        $eventUpdate->eventService = $inputs['eventService'];
        if(!empty($inputs['category'])):
            $eventUpdate->event_category_id = implode(',',$inputs['category']);
        else:
            $eventUpdate->event_category_id = '';
        endif;
        $eventUpdate->title = $inputs['title'];
        $eventUpdate->slug = Str::slug($inputs['title']);
        $eventUpdate->decription = $inputs['decription'];
        $eventUpdate->eventTicketsPrice = $inputs['eventTicketsPrice'];
        $eventUpdate->eventLocation = $inputs['eventLocation'];
        $eventUpdate->latitude = $inputs['latitude'];
        $eventUpdate->longitude = $inputs['longitude'];
        $eventUpdate->eventTickets = $inputs['eventTickets'];
        $eventUpdate->eventDate = $inputs['eventDate'];
        $eventUpdate->eventTime = $inputs['eventTime'];
        $eventUpdate->expireAt = $expire_at;
        $eventUpdate->status = $inputs['status'];
        if(!empty($inputs['featureImage'])):
            if(!empty($eventUpdate->featureImage)) {
                $featureImage_name = Str::afterLast($eventUpdate->featureImage, '/');
                if(File::exists(public_path('uploads/event_images/'.$featureImage_name))):
                    File::delete(public_path('uploads/event_images/'.$featureImage_name));
                endif;
            }                   
            $file= $inputs['featureImage'];
            $filename= Str::slug($inputs['title']).'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/event_images/'), $filename);
            $eventUpdate->featureImage = asset('/uploads/event_images/'.$filename);
        endif;
        if(!empty($inputs['GalleryImages'])):
            foreach($inputs['GalleryImages'] as $key=> $images): 
                $GalleryImages = new EventGallery;  
                $GalleryImages->event_id = $eventUpdate->id;        
                $file= $images;
                $filename= rand().'-'.$file->getClientOriginalName();
                $file->move(public_path('uploads/event_gallery/'), $filename);
                $GalleryImages->event_gallery_images = asset('/uploads/event_gallery/'.$filename);
                $GalleryImages->save();
            endforeach;            
        endif;
        $eventUpdate->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function sevicesList()
    {
        $eventsevicesList = Eventservice::with('EventByService')->orderBy('id','DESC')->paginate(20);       
        return view('admin.events.event-services-list',compact('eventsevicesList'));
    }

    public function addSevices()
    {
        return view('admin.events.event-service-add');
    }

    public function SaveSevices(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'title' => 'required', 
            'decription' => 'required',
            'featureImage' => 'mimes:png,jpg,jpeg'                     		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 

        $count = Eventservice::where('title',$inputs['title'])->count();
        if($count>0):
            return redirect()->back()->withErrors($inputs['title'].' already exit.');
        endif;
        $eventService = new Eventservice;
        $eventService->title = $inputs['title'];
        $eventService->slug = Str::slug($inputs['title']);
        $eventService->decription = $inputs['decription'];
        $eventService->status = $inputs['status'];
        if(!empty($inputs['featureImage'])):                   
            $file= $inputs['featureImage'];
            $filename= Str::slug($inputs['title']).'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/event_services_images/'), $filename);
            $eventService->featureImage = asset('/uploads/event_services_images/'.$filename);
        endif;
        $eventService->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function editSevices($slug)
    {
        $Checkservice = Eventservice::where('slug',$slug)->count();
        if($Checkservice>0):
            $servicesDetail = Eventservice::where('slug',$slug)->first();
            return view('admin.events.event-service-edit',compact('servicesDetail'));
        else:
            return redirect('admin/event/sevices/list');
        endif;        
    }

    public function eventenquiry(Request $request){

        $eventenquiryList = Eventenquery::get();

        return view('admin.event-enquiry-list',compact('eventenquiryList'));
        

    }

    public function UpdateSevices(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();        
        $rule=array(
            'title' => 'required', 
            'decription' => 'required',
            'featureImage' => 'mimes:png,jpg,jpeg'                      		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        } 
        $servicesDetail = Eventservice::where('id',decrypt($inputs['id']))->first();
        $count = Eventservice::where('title',$inputs['title'])->count();
        if($count>0 && $servicesDetail->title!=$inputs['title']):
            return redirect()->back()->withErrors($inputs['title'].' already exit.');
        endif;
        $services = Eventservice::where('id',decrypt($inputs['id']))->first();
        $services->title = $inputs['title'];
        $services->slug = Str::slug($inputs['title']);
        $services->decription = $inputs['decription'];
        $services->status = $inputs['status'];
        if(!empty($inputs['featureImage'])):
            if(!empty($services->featureImage)) {
                $featureImage_name = Str::afterLast($services->featureImage, '/');
                if(File::exists(public_path('uploads/event_services_images/'.$featureImage_name))):
                    File::delete(public_path('uploads/event_services_images/'.$featureImage_name));
                endif;
            }                    
            $file= $inputs['featureImage'];
            $filename= Str::slug($inputs['title']).'-'.$file->getClientOriginalName();
            $file-> move(public_path('uploads/event_services_images/'), $filename);
            $services->featureImage = asset('/uploads/event_services_images/'.$filename);
        endif;
        $services->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

}
