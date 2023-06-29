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
use App\Models\Package;
use App\Models\PackageFeature;

class PackagesController extends Controller
{

    public function features()
    {
        $features = PackageFeature::orderby('id','DESC')->paginate(20);
        return view('admin.packages.features-list',compact('features'));        
    }

    public function AddFeature()
    {
        return view('admin.packages.add-features');
    }

    public function SaveFeature(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'feature_name' => 'required|unique:package_features'                    		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $feature = new PackageFeature;
        $feature->feature_name = $inputs['feature_name'];
        $feature->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function EditFeatures($id)
    {
        $featureDetail = PackageFeature::findOrFail(decrypt($id));
        return view('admin.packages.edit-features',compact('featureDetail'));
    }

    public function UpdateFeatures(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $featureDetail = PackageFeature::findOrFail(decrypt($inputs['id']));
        $rule=array(
            'feature_name' => 'required|unique:package_features,feature_name,'.$featureDetail->id                   		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $featureDetail->feature_name = $inputs['feature_name'];
        $featureDetail->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function TrashFeature($id)
    {
        $PackageFeature = PackageFeature::findOrFail(decrypt($id));
        $PackageFeature->delete();
        return redirect()->back()->with('success', 'Feature trashed successfully.');
    }

    public function packagesList()
    {
        $packages = Package::orderby('id','DESC')->paginate(20);        
        return view('admin.packages.list',compact('packages'));        
    }

    public function packageAdd()
    {
        $features = PackageFeature::orderBy('id','DESC')->get();
        return view('admin.packages.add',compact('features'));
    }

    public function SavePackage(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $rule=array(
            'title' => 'required|unique:packages',
            'price' => 'required',
            'features' => 'required'                    		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $package = new Package;
        $package->title = $inputs['title'];
        $package->slug = Str::slug($inputs['title']);
        $package->price = $inputs['price'];
        $package->features = serialize($inputs['features']);
        $package->save();
        return redirect()->back()->with('success', 'Save successfully.');
    }

    public function EditPackage($id)
    {
        $packageInfo = Package::findOrFail(decrypt($id));        
        $features = PackageFeature::orderBy('id','DESC')->get();                
        return view('admin.packages.edit-package',compact('packageInfo','features'));
    }

    public function updatePackage(Request $request)
    {
        $data =  Request::except(array('_token')) ;        
        $inputs = Request::all();
        $packageDetail = Package::findOrFail(decrypt($inputs['id']));
        $rule=array(
            'title' => 'required|unique:packages,title,'.$packageDetail->id,
            'price' => 'required',
            'features' => 'required'                    		        	        
        );
        
        $validator = \Validator::make($data,$rule); 
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }
        $packageDetail->title = $inputs['title'];
        $packageDetail->slug = Str::slug($inputs['title']);
        $packageDetail->price = $inputs['price'];
        $packageDetail->features = serialize($inputs['features']);
        $packageDetail->save();
        return redirect()->back()->with('success', 'Update successfully.');
    }

    public function trashPackage($id)
    {
        $package = Package::findOrFail(decrypt($id));
        $package->delete();
        return redirect()->back()->with('success', 'Package trashed successfully.');
    }

}
