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

class AdminPortfoliosController extends Controller
{

    public function photoAlbums()
    {
        $photosAlbums = Portfolio::where('portfolios_type','images')->orderBy('id','DESC')->paginate(20);
        return view('admin.portfolios.photo-album-list', compact('photosAlbums'));
    }

    public function addPhotoAlbums()
    {
        return view('admin.portfolios.add-photo-album');
    }

    public function savePhotoAlbums(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array( 
            'albumName' => 'required|unique:portfolios'                     		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $savePhoto = new Portfolio;
        $savePhoto->albumName = $inputs['albumName'];
        $savePhoto->portfolios_type = 'images';
        $savePhoto->albumSlug = Str::slug($inputs['albumName']);
        $savePhoto->status = $inputs['status']; 
        $stroe_images = array();
        if(!empty($inputs['albumimages'])):
            foreach($inputs['albumimages'] as $key=> $images):              
                $file2= $images;
                $filename2= Str::slug($inputs['albumName']).'_album-image-'.rand().$file2->getClientOriginalName();
                $file2->move(public_path('uploads/portfolios/'), $filename2);
                $stroe_images[$key] = asset('/uploads/portfolios/'.$filename2);                           
            endforeach;
            $savePhoto->portfolios_images = serialize($stroe_images);
        endif;        
        if(!empty($inputs['featureImage'])): 
            $file= $inputs['featureImage'];
            $filename= Str::slug($inputs['albumName']).'_featureImage-'.$file->getClientOriginalName();
            $file->move(public_path('uploads/portfolios/'), $filename);
            $savePhoto->featureImage = asset('/uploads/portfolios/'.$filename);
        else:
            $savePhoto->featureImage = asset('/uploads/catalog-default-img.gif');
        endif;
        $savePhoto->save();
        return redirect()->back()->with('success', 'Album Create successfully.'); 
    }

    public function EditPhotoAlbums($slug)
    {
        $photoAlbum = Portfolio::where('portfolios_type','images')->where('albumSlug',$slug)->first();
        if($photoAlbum):
            return view('admin.portfolios.photo-album-edit',compact('photoAlbum'));
        else:
            return redirect('admin/portfolios/photo-albums');
        endif;
    }

    public function updatePhotoAlbums(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array( 
            'albumName' => 'required|unique:portfolios,id,'.decrypt($inputs['id'])                    		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        $updatePhotoAlbum = Portfolio::where('portfolios_type','images')->where('id',decrypt($inputs['id']))->first();
        if($updatePhotoAlbum):
            $updatePhotoAlbum->albumName = $inputs['albumName'];
            $updatePhotoAlbum->albumSlug = Str::slug($inputs['albumName']);
            $updatePhotoAlbum->status = $inputs['status'];            
            $stroe_images = array();
            if(!empty($inputs['albumimages'])):
                $portfolios_images = unserialize($updatePhotoAlbum->portfolios_images);
                foreach($inputs['albumimages'] as $key=> $images):              
                    $file2= $images;
                    $filename2= Str::slug($inputs['albumName']).'_album-image-'.rand().$file2->getClientOriginalName();
                    $file2->move(public_path('uploads/portfolios/'), $filename2);
                    $stroe_images[$key] = asset('/uploads/portfolios/'.$filename2);                           
                endforeach;
                if(!empty($portfolios_images)):
                    $marge_images = array_merge($stroe_images,$portfolios_images);
                    $updatePhotoAlbum->portfolios_images = serialize($marge_images);
                else:
                    $updatePhotoAlbum->portfolios_images = serialize($stroe_images);
                endif;
            endif; 

            if(!empty($inputs['featureImage'])): 
                if(!empty($updatePhotoAlbum->featureImage)) {
                    $featureImage_name = Str::afterLast($updatePhotoAlbum->featureImage, '/');
                    if(File::exists(public_path('uploads/portfolios/'.$featureImage_name))):
                        File::delete(public_path('uploads/portfolios/'.$featureImage_name));
                    endif;
                } 
                $file= $inputs['featureImage'];
                $filename= Str::slug($inputs['albumName']).'_featureImage-'.$file->getClientOriginalName();
                $file->move(public_path('uploads/portfolios/'), $filename);
                $updatePhotoAlbum->featureImage = asset('/uploads/portfolios/'.$filename);
            endif;
            $updatePhotoAlbum->save();
            return redirect('admin/portfolios/photo-albums/edit/'.$updatePhotoAlbum->albumSlug)->with('success', 'Update successfully.');
        else:
            return redirect('admin/portfolios/photo-albums');
        endif;
    }

    public function deletePhotoAlbums($slug)
    {
        $AlbumInfo = Portfolio::where('portfolios_type','images')->where('albumSlug',$slug)->first();
        if($AlbumInfo):
            if(!empty($AlbumInfo->featureImage)):
                $portfolios_image_name = Str::afterLast($AlbumInfo->featureImage, '/');
                if(File::exists(public_path('uploads/portfolios/'.$portfolios_image_name))):
                    File::delete(public_path('uploads/portfolios/'.$portfolios_image_name));
                endif;
            endif;
            if(!empty($AlbumInfo->portfolios_images)):
                $getImages = unserialize($AlbumInfo->portfolios_images);
                foreach($getImages as $key=>$albumImages):                    
                    $portfolios_image_name2 = Str::afterLast($albumImages, '/');
                    if(File::exists(public_path('uploads/portfolios/'.$portfolios_image_name2))):
                        File::delete(public_path('uploads/portfolios/'.$portfolios_image_name2));
                    endif;
                endforeach;            
            endif;            
            Portfolio::where('portfolios_type','images')->where('albumSlug',$slug)->delete();
            return redirect('admin/portfolios/photo-albums')->with('success', 'Delete successfully.');
        else:
            return redirect('admin/portfolios/photo-albums');
        endif;
    }

    public function videoAlbums()
    {
        return view('admin.portfolios.video-album-list');
    }

    public function portfolios()
    {
        $Portfolio_images = Portfolio::where('portfolios_type','images')->orderBy('id','DESC')->get();
        $Portfolio_videos = Portfolio::where('portfolios_type','videos')->orderBy('id','DESC')->get();
        return view('admin.portfolios.list' , compact('Portfolio_images','Portfolio_videos'));
    }

    public function uploadPhotos(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();       
        if(!empty($inputs['images'])):            
            foreach($inputs['images'] as $key=> $images): 
                $PortfolioImages = new Portfolio;  
                $PortfolioImages->portfolios_type = 'images';              
                $file= $images;
                $filename= rand().'-'.$file->getClientOriginalName();
                $file->move(public_path('uploads/portfolios/'), $filename);
                $PortfolioImages->portfolios_images = asset('/uploads/portfolios/'.$filename);
                $PortfolioImages->save();
            endforeach;
            return response()->json([
                'successUpload' => 'Images upload successfully.'
            ]);
        else:
            return response()->json([
                'errorMsg' => 'Please choose images.'
            ]);
        endif;     
    }

    public function portfolioImageDelete($imageID)
    {
        $imagesDetail = Portfolio::findOrFail($imageID);
        if(!empty($imagesDetail->portfolios_images)) {
            $portfolios_image_name = Str::afterLast($imagesDetail->portfolios_images, '/');
            if(File::exists(public_path('uploads/portfolios/'.$portfolios_image_name))):
                File::delete(public_path('uploads/portfolios/'.$portfolios_image_name));
            endif;
        } 
        Portfolio::where('id',$imageID)->delete();
        return response()->json([
            'imageDeleted' => 'Images delete successfully.'
        ]);

    }

    public function uploadvideos(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        if(!empty($inputs['videoUrl'])):
            $PortfolioVideo = new Portfolio;  
            $PortfolioVideo->portfolios_type = 'videos';
            $PortfolioVideo->upload_video = $inputs['videoUrl'];
            $PortfolioVideo->save();
            return response()->json([
                'successUpload' => 'Save successfully.'
            ]);
        else:
            return response()->json([
                'errorMsg' => 'Please enter youtube URL.'
            ]);
        endif;
    }

}
