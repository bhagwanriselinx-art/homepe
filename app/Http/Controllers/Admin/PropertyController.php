<?php

namespace App\Http\Controllers\Admin;

use Auth;
use File;
use Image;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Aminity;
use App\Models\Booking;
use App\Models\Compare;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Property;
use App\Models\Wishlist;
use App\Models\PropertyPlan;
use Illuminate\Http\Request;
use App\Models\PropertySlider;
use App\Models\NearestLocation;
use App\Models\PropertyAminity;
use App\Http\Controllers\Controller;
use App\Models\AdditionalInformation;
use App\Models\PropertyNearestLocation;
use App\Models\SubPropertyType;
use App\Models\ChildSubPropertyType;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('check_slug');
    }

    public function index(){

        $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', 0)->get();

        return view('admin.own_property', compact('properties'));
    }

    public function agent_property(Request $request){

        if($request->agent_id){
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', $request->agent_id);

            if($request->type){
                $properties = $properties->where('status', $request->type);
            }
            $properties = $properties->get();
        }else{
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', '!=', 0)->get();
        }

        return view('admin.agent_properties', compact('properties'));
    }

    public function agent_pending_property(Request $request){

        if($request->agent_id){
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', $request->agent_id)->where('approve_by_admin', 'pending')->get();
        }else{
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', '!=', 0)->where('approve_by_admin', 'pending')->get();
        }

        return view('admin.agent_pending_property', compact('properties'));
    }

    public function agent_reject_property(Request $request){

        if($request->agent_id){
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', $request->agent_id)->where('approve_by_admin', 'reject')->get();
        }else{
            $properties = Property::with('property_type')->orderBy('id','desc')->where('agent_id', '!=', 0)->where('approve_by_admin', 'reject')->get();
        }

        return view('admin.agent_reject_property', compact('properties'));
    }




    public function create(){

        $types = Category::where('status', 1)->get();
        $cities = City::all();
        $aminities = Aminity::all();
        $nearest_locations = NearestLocation::orderBy('id', 'desc')->where('status', 1)->get();
        $countries = Country::orderBy('id', 'desc')->get();
        $setting = Setting::first();
$property = null;
        $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
        $agent_arr = array();

        foreach($agent_order as $agent){
            $agent_arr[] = $agent->agent_id;
        }

        $agents = User::whereIn('id', $agent_arr)->select('id','name','email','phone')->get();

        return view('admin.property_create')->with([
            'types' => $types,
            'cities' => $cities,
            'aminities' => $aminities,
            'nearest_locations' => $nearest_locations,
            'agents' => $agents,
            'countries' => $countries,
            'setting' => $setting,
            'property' =>$property,
        ]);
    }

    // public function store(Request $request){

    //     if($request->owner_id != 0){
    //         $agent_id = $request->owner_id;
    //         $agent_order = Order::where('agent_id', $agent_id)->orderBy('id','desc')->first();

    //         if($agent_order){

    //             $available = 'disable';

    //             $expiration_date = $agent_order->expiration_date;

    //             if($expiration_date != 'lifetime'){
    //                 if(date('Y-m-d') > $expiration_date){
    //                     $notification = trans('admin_validation.Pricing plan date is expired');
    //                     $notification = array('messege'=>$notification,'alert-type'=>'error');
    //                     return redirect()->back()->with($notification);
    //                 }
    //             }

    //             $number_of_property = $agent_order->number_of_property;

    //             if($number_of_property == -1){
    //                 $available = 'enable';
    //             }else{
    //                 $property_count = Property::where('agent_id', $agent_id)->count();
    //                 if($property_count < $number_of_property){
    //                     $available = 'enable';
    //                 }
    //             }

    //             if($available == 'disable'){
    //                 $notification = trans('admin_validation.You can not add property more than limit quantity');
    //                 $notification = array('messege'=>$notification,'alert-type'=>'error');
    //                 return redirect()->back()->with($notification);
    //             }

    //         }else{
    //             $notification = trans('admin_validation.Agent does not have any pricing plan');
    //             $notification = array('messege'=>$notification,'alert-type'=>'error');
    //             return redirect()->back()->with($notification);
    //         }
    //     }

    //     $live_map = Setting::first()->live_map;

    //     $rules = [
    //         'title'=>'required|unique:properties',
    //         'slug'=>'required|unique:properties',
    //         'property_type_id'=>'required',
    //         'purpose'=> 'required',
    //         'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
    //         'price'=>'required',
    //         'description'=>'required',
    //         'city_id'=>'required',
    //         'country_id'=>'required',
    //         'address'=>'required',
    //         'address_description'=>'required',
    //         'google_map'=> $live_map == 'no' ? 'required' : '',
    //         'total_area'=>'required',
    //         'total_unit'=>'required',
    //         'total_bedroom'=>'required',
    //         'total_bathroom'=>'required',
    //         'total_garage'=>'required',
    //         'total_kitchen'=>'required',
    //         'thumbnail_image'=>'required',
    //         'lat' => $live_map == 'yes' ? 'required' : '',
    //         'lng' => $live_map == 'yes' ? 'required' : ''
    //     ];
    //     $customMessages = [
    //         'title.required' => trans('admin_validation.Title is required'),
    //         'title.unique' => trans('admin_validation.Title already exist'),
    //         'slug.required' => trans('admin_validation.Slug is required'),
    //         'slug.unique' => trans('admin_validation.Slug already exist'),
    //         'property_type_id.required' => trans('admin_validation.Property type is required'),
    //         'purpose.required' => trans('admin_validation.Purpose is required'),
    //         'rent_period.required' => trans('admin_validation.Rent period is required'),
    //         'price.required' => trans('admin_validation.Price is required'),
    //         'description.required' => trans('admin_validation.Description is required'),
    //         'city_id.required' => trans('admin_validation.City is required'),
    //         'country_id.required' => trans('admin_validation.Country is required'),
    //         'address.required' => trans('admin_validation.Address is required'),
    //         'address_description.required' => trans('admin_validation.Address details is required'),
    //         'google_map.required' => trans('admin_validation.Google map is required'),
    //         'total_area.required' => trans('admin_validation.Total area is required'),
    //         'total_unit.required' => trans('admin_validation.Total unit is required'),
    //         'total_bedroom.required' => trans('admin_validation.Total bedroom is required'),
    //         'total_bathroom.required' => trans('admin_validation.Total bathroom is required'),
    //         'total_garage.required' => trans('admin_validation.Total garage is required'),
    //         'total_kitchen.required' => trans('admin_validation.Total kitchen is required'),
    //         'thumbnail_image.required' => trans('admin_validation.Thumbnail image is required'),
    //         'lat.required' => trans('admin_validation.The latitude is required'),
    //         'lng.required' => trans('admin_validation.The longitude is required'),
    //     ];

    //     $this->validate($request, $rules,$customMessages);

    //     $property = new Property();
    //     $property->agent_id = $request->owner_id;
    //     $property->title = $request->title;
    //     $property->slug = $request->slug;
    //     $property->property_type_id = $request->property_type_id;
    //     $property->purpose = $request->purpose;
    //     $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : '';
    //     $property->price = $request->price;
    //     $property->description = $request->description;

    //     $property->total_area = $request->total_area;
    //     $property->total_unit = $request->total_unit;
    //     $property->total_bedroom = $request->total_bedroom;
    //     $property->total_bathroom = $request->total_bathroom;
    //     $property->total_garage = $request->total_garage;
    //     $property->total_kitchen = $request->total_kitchen;
    //     $property->total_bathroom = $request->total_bathroom;

    //     $property->city_id = $request->city_id;
    //     $property->country_id = $request->country_id;
    //     $property->address = $request->address;
    //     $property->address_description = $request->address_description;
    //     $property->google_map = $request->google_map;
    //     $property->lat = $request->lat;
    //     $property->lon = $request->lng;

    //     $property->video_id = $request->video_id;
    //     $property->video_description = $request->video_description;

    //     if($request->thumbnail_image){
    //         $extention = $request->thumbnail_image->getClientOriginalExtension();
    //         $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //         $image_name = 'uploads/custom-images/'.$image_name;
    //         Image::make($request->thumbnail_image)
    //             ->encode('webp', 80)
    //             ->save(public_path().'/'.$image_name);
    //         $property->thumbnail_image = $image_name;
    //     }

    //     if($request->video_thumbnail){
    //         $extention = $request->video_thumbnail->getClientOriginalExtension();
    //         $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //         $image_name = 'uploads/custom-images/'.$image_name;
    //         Image::make($request->video_thumbnail)
    //             ->encode('webp', 80)
    //             ->save(public_path().'/'.$image_name);
    //         $property->video_thumbnail = $image_name;
    //     }


    //     $property->seo_title = $request->seo_title ? $request->seo_title : $request->title;
    //     $property->seo_meta_description = $request->seo_meta_description ? $request->seo_meta_description : $request->title;
    //     $property->status = $request->status ? 'enable' : 'disable';
    //     $property->is_featured = $request->is_featured ? 'enable' : 'disable';
    //     $property->is_top = $request->is_top ? 'enable' : 'disable';
    //     $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';
    //     $property->approve_by_admin = 'approved';
    //     if($request->owner_id != 0){
    //         if($agent_order->expiration_date == 'lifetime'){
    //             $property->expired_date = null;
    //         }else{
    //             $property->expired_date = $agent_order->expiration_date;
    //         }
    //     }
    //     $property->date_from = $request->date_form;
    //     $property->date_to = $request->date_to;
    //     $property->time_from = $request->time_form;
    //     $property->time_to = $request->time_to;
    //     $property->save();

    //     if($request->aminities){
    //         foreach($request->aminities as $aminity){
    //             $item = new PropertyAminity();
    //             $item->aminity_id = $aminity;
    //             $item->property_id = $property->id;
    //             $item->save();
    //         }
    //     }

    //     if($request->slider_images){
    //         foreach($request->slider_images as $index => $image){
    //             $extention = $image->getClientOriginalExtension();
    //             $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //             $image_name = 'uploads/custom-images/'.$image_name;
    //             Image::make($image)
    //                 ->encode('webp', 80)
    //                 ->save(public_path().'/'.$image_name);

    //             $slider = new PropertySlider();
    //             $slider->property_id = $property->id;
    //             $slider->image = $image_name;
    //             $slider->save();
    //         }
    //     }

    //     if($request->nearest_locations && $request->distances){
    //         foreach($request->nearest_locations as $index => $nearest_location){
    //             if($request->nearest_locations[$index] != '' && $request->distances[$index] != ''){
    //                 $new_loc = new PropertyNearestLocation();
    //                 $new_loc->property_id = $property->id;
    //                 $new_loc->nearest_location_id = $request->nearest_locations[$index];
    //                 $new_loc->distance = $request->distances[$index];
    //                 $new_loc->save();
    //             }
    //         }
    //     }

    //     if($request->add_keys && $request->add_values){
    //         foreach($request->add_keys as $index => $add_key){
    //             if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
    //                 $new_loc = new AdditionalInformation();
    //                 $new_loc->property_id = $property->id;
    //                 $new_loc->add_key = $request->add_keys[$index];
    //                 $new_loc->add_value = $request->add_values[$index];
    //                 $new_loc->save();
    //             }
    //         }
    //     }

    //     if($request->plan_images && $request->plan_titles && $request->plan_descriptions){
    //         foreach($request->plan_images as $index => $image){
    //             if($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]){
    //                 $extention = $image->getClientOriginalExtension();
    //                 $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //                 $image_name = 'uploads/custom-images/'.$image_name;
    //                 Image::make($image)
    //                     ->encode('webp', 80)
    //                     ->save(public_path().'/'.$image_name);

    //                 $plan = new PropertyPlan();
    //                 $plan->property_id = $property->id;
    //                 $plan->image = $image_name;
    //                 $plan->title = $request->plan_titles[$index];
    //                 $plan->description = $request->plan_descriptions[$index];
    //                 $plan->save();
    //             }
    //         }
    //     }

    //     $notification = trans('admin_validation.Created succssfully');
    //     $notification = array('messege'=>$notification,'alert-type'=>'success');
    //     return redirect()->back()->with($notification);
    // }
public function store(Request $request){

    /* =========================================
       AGENT PLAN CHECK (UNCHANGED)
    ==========================================*/

    if($request->owner_id != 0){
        $agent_id = $request->owner_id;
        $agent_order = Order::where('agent_id', $agent_id)->orderBy('id','desc')->first();

        if($agent_order){

            $available = 'disable';
            $expiration_date = $agent_order->expiration_date;

            if($expiration_date != 'lifetime'){
                if(date('Y-m-d') > $expiration_date){
                    return redirect()->back()->with([
                        'messege'=>trans('admin_validation.Pricing plan date is expired'),
                        'alert-type'=>'error'
                    ]);
                }
            }

            $number_of_property = $agent_order->number_of_property;

            if($number_of_property == -1){
                $available = 'enable';
            }else{
                $property_count = Property::where('agent_id', $agent_id)->count();
                if($property_count < $number_of_property){
                    $available = 'enable';
                }
            }

            if($available == 'disable'){
                return redirect()->back()->with([
                    'messege'=>trans('admin_validation.You can not add property more than limit quantity'),
                    'alert-type'=>'error'
                ]);
            }

        }else{
            return redirect()->back()->with([
                'messege'=>trans('admin_validation.Agent does not have any pricing plan'),
                'alert-type'=>'error'
            ]);
        }
    }

    /* =========================================
       VALIDATION
    ==========================================*/

    $live_map = Setting::first()->live_map;

    $rules = [
        'title'=>'required|unique:properties',
        'slug'=>'required|unique:properties',
        'category_type'=>'required',
        'property_type_id'=>'required',
        'purpose'=> 'required',
        'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
        'sub_property_type_id'=>'nullable|exists:sub_property_types,id',
        'price'=>'required',
        'description'=>'required',
        'city_id'=>'required',
        'country_id'=>'required',
        'address'=>'required',
        'address_description'=>'required',
        'google_map'=> $live_map == 'no' ? 'required' : '',
        'total_area'=>'required',
        'total_unit'=>'required',
        'total_bedroom'=>'required',
        'total_bathroom'=>'required',
        'total_garage'=>'required',
        'total_kitchen'=>'required',
        'thumbnail_image'=>'required',
        'lat' => $live_map == 'yes' ? 'required' : '',
        'lng' => $live_map == 'yes' ? 'required' : ''
    ];

    $this->validate($request, $rules);

    /* =========================================
       STRICT SUB TYPE VALIDATION
    ==========================================*/

    if($request->sub_property_type_id){
        $validSubType = SubPropertyType::where('id',$request->sub_property_type_id)
            ->where('category_id',$request->property_type_id) // ðŸ”¥ change here
                            ->exists();

        if(!$validSubType){
            return back()->withErrors(['sub_property_type_id'=>'Invalid Sub Property Type']);
        }
    }

    /* =========================================
       SAVE PROPERTY
    ==========================================*/

    $property = new Property();

    $property->agent_id = $request->owner_id;
    $property->title = $request->title;
    $property->slug = $request->slug;

    $property->category_type = $request->category_type; // NEW
    $property->property_type_id = $request->property_type_id;
    $property->sub_property_type_id = $request->sub_property_type_id; // NEW

    $property->purpose = $request->purpose;
    $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : null;

    $property->price = $request->price;
    $property->description = $request->description;

    $property->total_area = $request->total_area;
    $property->total_unit = $request->total_unit;
    $property->total_bedroom = $request->total_bedroom;
    $property->total_bathroom = $request->total_bathroom;
    $property->total_garage = $request->total_garage;
    $property->total_kitchen = $request->total_kitchen;

    $property->city_id = $request->city_id;
    $property->country_id = $request->country_id;
    $property->address = $request->address;
    $property->address_description = $request->address_description;
    $property->google_map = $request->google_map;
    $property->lat = $request->lat;
    $property->lon = $request->lng;

    $property->video_id = $request->video_id;
    $property->video_description = $request->video_description;

    /* IMAGE UPLOAD */

    if($request->thumbnail_image){
        $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
        $image_path = 'uploads/custom-images/'.$image_name;

        Image::make($request->thumbnail_image)
            ->encode('webp', 80)
            ->save(public_path().'/'.$image_path);

        $property->thumbnail_image = $image_path;
    }

    if($request->video_thumbnail){
        $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
        $image_path = 'uploads/custom-images/'.$image_name;

        Image::make($request->video_thumbnail)
            ->encode('webp', 80)
            ->save(public_path().'/'.$image_path);

        $property->video_thumbnail = $image_path;
    }

    $property->seo_title = $request->seo_title ?? $request->title;
    $property->seo_meta_description = $request->seo_meta_description ?? $request->title;

    $property->status = $request->status ? 'enable' : 'disable';
    $property->is_featured = $request->is_featured ? 'enable' : 'disable';
    $property->is_top = $request->is_top ? 'enable' : 'disable';
    $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';
    $property->approve_by_admin = 'approved';

    $property->save();

    /* =========================================
       AMINITIES
    ==========================================*/
if($request->add_keys && $request->add_values){
             foreach($request->add_keys as $index => $add_key){
             if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
                     $new_loc = new AdditionalInformation();
                    $new_loc->property_id = $property->id;
                 $new_loc->add_key = $request->add_keys[$index];
                    $new_loc->add_value = $request->add_values[$index];
                  $new_loc->save();
                }
            }
         }

    /* =========================================
       SLIDER IMAGES
    ==========================================*/

    if($request->slider_images){
        foreach($request->slider_images as $image){

            $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
            $image_path = 'uploads/custom-images/'.$image_name;

            Image::make($image)
                ->encode('webp', 80)
                ->save(public_path().'/'.$image_path);

            PropertySlider::create([
                'property_id'=>$property->id,
                'image'=>$image_path
            ]);
        }
    }

    return redirect()->back()->with([
        'messege'=>trans('admin_validation.Created succssfully'),
        'alert-type'=>'success'
    ]);
}


// public function saveStep(Request $request)
// {
//     $step = $request->step;

//     // Create or Update
//     if ($request->property_id) {
//         $property = Property::findOrFail($request->property_id);
//     } else {
//         $property = new Property();
//         $property->approve_by_admin = 'pending';
//         $property->status = 'disable';
//     }

//     /* =========================================
//       STEP 1 : BASIC
//     ==========================================*/
//     if ($step == 1) {

//         $request->validate([
//             'title' => 'required',
//             'slug' => 'required',
//             'category_type' => 'required',
//             'property_type_id' => 'required',
//             'purpose' => 'required',
//         ]);

//         $property->agent_id = $request->owner_id;
//         $property->title = $request->title;
//         $property->slug = $request->slug;
//         $property->category_type = $request->category_type;
//         $property->property_type_id = $request->property_type_id;
//         $property->sub_property_type_id = $request->sub_property_type_id;
//         $property->purpose = $request->purpose;
//         $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : null;
//         $property->price = $request->price;
//         $property->description = $request->description;
//         $property->total_area = $request->total_area;
//         $property->total_unit = $request->total_unit;
//         $property->total_bedroom = $request->total_bedroom;
//         $property->total_bathroom = $request->total_bathroom;
//         $property->total_garage = $request->total_garage;
//         $property->total_kitchen = $request->total_kitchen;
//                 $property->child_sub_property_type_id = $request->child_sub_property_type_id; // 🔥 NEW

//     }

//     /* =========================================
//       STEP 2 : LOCATION
//     ==========================================*/
//     if ($step == 2) {

//         $request->validate([
//             'country_id' => 'required',
//             'city_id' => 'required',
//             'address' => 'required',
//         ]);

//         $property->country_id = $request->country_id;
//         $property->city_id = $request->city_id;
//         $property->address = $request->address;
//         $property->address_description = $request->address_description;
//         $property->google_map = $request->google_map;
//         $property->lat = $request->lat;
//         $property->lon = $request->lng;
//           $property->locality = $request->locality;
//     $property->sub_locality = $request->sub_locality;
//     $property->full_address = $request->full_address;
//     }

//     /* =========================================
//       STEP 3 : MEDIA
//     ==========================================*/
//     /* =========================================
//   STEP 3 : PROPERTY CONFIGURATION
// ==========================================*/
// if ($step == 3) {

//     $property->price = $request->price;
//     $property->description = $request->description;
//     $property->total_area = $request->total_area;
//     $property->total_unit = $request->total_unit;
//     $property->total_bedroom = $request->total_bedroom;
//     $property->total_bathroom = $request->total_bathroom;
//     $property->total_garage = $request->total_garage;
//     $property->total_kitchen = $request->total_kitchen;
    
// $property->configuration_json = $request->configuration_json;

// }
//   if ($step == 4) {

//     // Thumbnail
//     if ($request->hasFile('thumbnail_image')) {
//         $image = $request->file('thumbnail_image');

//         $image_name = 'thumb-'.time().'.webp';
//         $path = 'uploads/custom-images/'.$image_name;

//         Image::make($image)
//             ->encode('webp',80)
//             ->save(public_path($path));

//         $property->thumbnail_image = $path;
//     }

//     // Slider Images
//     if ($request->hasFile('slider_images')) {
//         foreach ($request->file('slider_images') as $image) {

//             $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
//             $image_path = 'uploads/custom-images/'.$image_name;

//             Image::make($image)
//                 ->encode('webp', 80)
//                 ->save(public_path($image_path));

//             PropertySlider::create([
//                 'property_id' => $property->id,
//                 'image' => $image_path
//             ]);
//         }
//     }

//     // Video
//     $property->video_id = $request->video_id;
//     $property->video_description = $request->video_description;

//     // 🔥 SAVE
   
// }
//     /* =========================================
//       STEP 4 : AMENITIES
//     ==========================================*/
//   if ($step == 5) {

//     // Existing Amenities (UNCHANGED)
//     if ($request->aminities) {
//         $property->aminities()->sync($request->aminities);
//     }

//     // Existing Nearest Location (UNCHANGED)
//     if ($request->nearest_locations) {
//         $nearest = [];
//         foreach ($request->nearest_locations as $key => $value) {
//             if ($value) {
//                 $nearest[] = [
//                     'location_id' => $value,
//                     'distance' => $request->distances[$key] ?? null
//                 ];
//             }
//         }
//         $property->nearest_info = json_encode($nearest);
//     }

//     // 🔥 NEW FIELDS ADDED BELOW (Nothing removed above)

//     // Club Features
//     $property->club_features = $request->club_features
//         ? json_encode($request->club_features)
//         : null;

//     // Proximity Highlights
//     $property->proximity_highlights = $request->proximity_highlights
//         ? json_encode($request->proximity_highlights)
//         : null;

//     // Floor Details
//     $property->floor_details = $request->floor_details;

//     // Ownership Type
//     $property->ownership_type = $request->ownership_type;

//     // Previously Used
//     $property->is_previously_used = $request->is_previously_used ?? 0;

//     // Location Advantages
//     $property->location_advantages = $request->location_advantages
//         ? json_encode($request->location_advantages)
//         : null;

//     // Fire Safety (if added in migration)
//     $property->fire_safety = $request->fire_safety
//         ? json_encode($request->fire_safety)
//         : null;

//     // CCTV
//     $property->cctv_available = $request->cctv_available ?? null;

//     // Staircases
//     $property->no_of_staircases = $request->no_of_staircases;

//     // NOC
//     $property->noc_certified = $request->noc_certified ?? null;

//     // Occupancy Certificate
//     $property->occupancy_certificate = $request->occupancy_certificate ?? null;

//     // Previously Used For
//     $property->previously_used_for = $request->previously_used_for;
// }
//     /* =========================================
//       STEP 5 : ADDITIONAL + SEO
//     ==========================================*/
// if ($step == 6) {

//     /* =========================================
//       VALIDATION (Pricing + Brokerage + Lease)
//     ==========================================*/
//     $request->validate([
//         'expected_price' => 'nullable|numeric|min:0',
//         'price_per_unit' => 'nullable|numeric|min:0',
//         'maintenance_charge' => 'nullable|numeric|min:0',

//         'brokerage_type' => 'nullable|required_if:brokerage_required,1',
//         'brokerage_amount' => 'nullable|required_if:brokerage_required,1|numeric|min:0',

//         'current_rent' => 'nullable|required_if:is_preleased,1|numeric|min:0',
//         'lease_tenure' => 'nullable|required_if:is_preleased,1',
//         'annual_rent_increase' => 'nullable|numeric|min:0|max:100',
//     ]);


//     /* =========================================
//       ADDITIONAL INFORMATION (UNCHANGED)
//     ==========================================*/
//     AdditionalInformation::where('property_id',$property->id)->delete();

//     if ($request->add_keys) {
//         foreach ($request->add_keys as $index => $key) {
//             if ($key && $request->add_values[$index]) {
//                 AdditionalInformation::create([
//                     'property_id' => $property->id,
//                     'add_key' => $key,
//                     'add_value' => $request->add_values[$index],
//                 ]);
//             }
//         }
//     }


//     /* =========================================
//       PRICING MODULE
//     ==========================================*/
//     $property->expected_price = $request->expected_price;
//     $property->price_per_unit = $request->price_per_unit;

//     $property->tax_excluded = $request->tax_excluded ? 1 : 0;
//     $property->tax_included = $request->tax_included ? 1 : 0;
//     $property->price_negotiable = $request->price_negotiable ? 1 : 0;

//     $property->maintenance_type = $request->maintenance_type;
//     $property->maintenance_charge = $request->maintenance_charge;


//     /* =========================================
//       BROKERAGE MODULE
//     ==========================================*/
//     $property->brokerage_required = $request->brokerage_required ? 1 : 0;
//     $property->brokerage_type = $request->brokerage_type;
//     $property->brokerage_amount = $request->brokerage_amount;


//     /* =========================================
//       PRE-LEASED MODULE
//     ==========================================*/
//     $property->is_preleased = $request->is_preleased ? 1 : 0;
//     $property->current_rent = $request->current_rent;
//     $property->lease_tenure = $request->lease_tenure;
//     $property->annual_rent_increase = $request->annual_rent_increase;
//     $property->leased_to = $request->leased_to;


//     /* =========================================
//       DESCRIPTION
//     ==========================================*/
//     $property->pricing_description = $request->pricing_description;


//     /* =========================================
//       EXISTING SEO + STATUS (UNCHANGED)
//     ==========================================*/
//     $property->seo_title = $request->seo_title;
//     $property->seo_meta_description = $request->seo_meta_description;
//     $property->status = $request->status ? 'enable' : 'disable';
//     $property->is_featured = $request->is_featured ? 'enable' : 'disable';
//     $property->is_top = $request->is_top ? 'enable' : 'disable';
//     $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';
// }
//     $property->save();

//     return response()->json([
//         'status' => 'success',
//         'property_id' => $property->id,
//         'message' => 'Step saved successfully'
//     ]);
// }


public function saveStep(Request $request)
{
    $step = $request->step;

    // Create or Update
    if ($request->property_id) {
        $property = Property::findOrFail($request->property_id);
        $property->approve_by_admin = 'approved';
        $property->status = 'Enable';
    } else {
        $property = new Property();
        $property->approve_by_admin = 'approved';
        $property->status = 'Enable';
    }
// 🔒 STEP CONTROL (VERY IMPORTANT)
// 🔒 APPLY ONLY FOR CREATE (NO property_id)
if (!$request->property_id) {

    if ($request->step > 1) {
        return response()->json([
            'status' => 'error',
            'message' => 'Please complete Step 1 first!'
        ], 400);
    }
}
    /* =========================================
       STEP 1 : BASIC
    ==========================================*/
    if ($step == 1) {

        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'category_type' => 'required',
            'property_type_id' => 'required',
            'purpose' => 'required',
        ]);

        $property->agent_id = $request->owner_id;
        $property->title = $request->title;
        $property->slug = $request->slug;
        $property->category_type = $request->category_type;
        $property->property_type_id = $request->property_type_id;
        $property->sub_property_type_id = $request->sub_property_type_id;
        $property->child_sub_property_type_id = $request->child_sub_property_type_id;
        $property->purpose = $request->purpose;
        $property->description = $request->description;
       

        $property->save(); // 🔥 SAVE HERE
    }

    /* =========================================
       STEP 2 : LOCATION
    ==========================================*/
    if ($step == 2) {

    $request->validate([
        'country_id' => 'required',
        'city_id' => 'required',
        'address' => 'required',
        'building_name' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
    ]);

    $property->country_id = $request->country_id;
    $property->city_id = $request->city_id;

    // 🔥 NEW FIELDS
    $property->building_name = $request->building_name;
    $property->state = $request->state;

    $property->address = $request->address;
    $property->address_description = $request->address_description;
    $property->google_map = $request->google_map;
    $property->lat = $request->lat;
    $property->lon = $request->lng;
    $property->locality = $request->locality;
    $property->sub_locality = $request->sub_locality;
    $property->full_address = $request->full_address;

    $property->save();
}

    /* =========================================
       STEP 3 : CONFIG
    ==========================================*/
    if ($step == 3) {

        
        $property->configuration_json = $request->configuration_json;

        $property->save();
    }

    /* =========================================
       STEP 4 : IMAGES + VIDEO
    ==========================================*/
  if ($step == 4) {

    // 🔥 ensure property saved
    if (!$property->id) {
        $property->save();
    }
// =========================
// 🔥 REMOVE THUMBNAIL IMAGE
// =========================
if ($request->remove_thumbnail == 1 && $property->thumbnail_image) {

    if (file_exists(public_path($property->thumbnail_image))) {
        unlink(public_path($property->thumbnail_image));
    }

    $property->thumbnail_image = null;
}


// =========================
// 🔥 UPLOAD THUMBNAIL IMAGE
// =========================
if ($request->hasFile('thumbnail_image')) {

    $file = $request->file('thumbnail_image');

    if ($file && $file->isValid()) {

        // OLD DELETE
        if ($property->thumbnail_image && file_exists(public_path($property->thumbnail_image))) {
            unlink(public_path($property->thumbnail_image));
        }

        $name = 'thumb-' . time() . '-' . uniqid() . '.webp';
        $path = 'uploads/custom-images/' . $name;

        Image::make($file)
            ->encode('webp', 80)
            ->save(public_path($path));

        $property->thumbnail_image = $path;
    }
}
 // =========================
    // REMOVE VIDEO THUMBNAIL
    // =========================
    if ($request->remove_video_thumbnail == 1) {

        if (!empty($property->video_thumbnail) && file_exists(public_path($property->video_thumbnail))) {
            unlink(public_path($property->video_thumbnail));
        }

        $property->video_thumbnail = null;
    }

    // =========================
    // UPLOAD VIDEO THUMBNAIL (IMAGE)
    // =========================
    if ($request->hasFile('video_thumbnail')) {

        $file = $request->file('video_thumbnail');

        if ($file && $file->isValid()) {

            if (!empty($property->video_thumbnail) && file_exists(public_path($property->video_thumbnail))) {
                unlink(public_path($property->video_thumbnail));
            }

            $name = 'video-thumb-' . time() . '-' . uniqid() . '.webp';
            $path = 'uploads/custom-images/' . $name;

            Image::make($file)
                ->encode('webp', 80)
                ->save(public_path($path));

            $property->video_thumbnail = $path;
        }
    }

    // =========================
    // REMOVE VIDEO FILE
    // =========================
    if ($request->remove_video == 1) {

        if (!empty($property->video_path) && file_exists(public_path($property->video_path))) {
            unlink(public_path($property->video_path));
        }

        $property->video_path = null;
    }

    // =========================
    // UPLOAD VIDEO FILE
    // =========================
    if ($request->hasFile('video_file')) {

        $file = $request->file('video_file');

        if ($file && $file->isValid()) {

            if (!empty($property->video_path) && file_exists(public_path($property->video_path))) {
                unlink(public_path($property->video_path));
            }

            $name = 'video-' . time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/videos/' . $name;

            $file->move(public_path('uploads/videos'), $name);

            $property->video_path = $path;
        }
    }

    // =========================
    // 🔥 REMOVE SLIDER IMAGES
    // =========================
    if ($request->remove_slider_ids) {

        foreach ($request->remove_slider_ids as $id) {

            $slider = PropertySlider::find($id);

            if ($slider) {

                if (file_exists(public_path($slider->image))) {
                    unlink(public_path($slider->image));
                }

                $slider->delete();
            }
        }
    }

    // =========================
    // 🔥 ADD NEW SLIDER
    // =========================
    if ($request->hasFile('slider_images')) {

        foreach ($request->file('slider_images') as $image) {

            $name = 'slider-' . time() . rand(100,999) . '.webp';
            $path = 'uploads/custom-images/' . $name;

            Image::make($image)->encode('webp', 80)->save(public_path($path));

            PropertySlider::create([
                'property_id' => $property->id,
                'image' => $path
            ]);
        }
    }

    // =========================
    // 🔥 VIDEO THUMBNAIL REMOVE
    // =========================
    if ($request->remove_video_thumbnail == 1 && $property->video_thumbnail) {

        if (file_exists(public_path($property->video_thumbnail))) {
            unlink(public_path($property->video_thumbnail));
        }

        $property->video_thumbnail = null;
    }

    // =========================
    // 🔥 VIDEO THUMBNAIL UPLOAD
    // =========================
    if ($request->hasFile('video_thumbnail')) {

        if ($property->video_thumbnail && file_exists(public_path($property->video_thumbnail))) {
            unlink(public_path($property->video_thumbnail));
        }

        $image = $request->file('video_thumbnail');

        $name = 'video-thumb-' . time() . '.webp';
        $path = 'uploads/custom-images/' . $name;

        Image::make($image)->encode('webp', 80)->save(public_path($path));

        $property->video_thumbnail = $path;
    }

    // =========================
    // 🔥 VIDEO DATA
    // =========================
    $property->video_id = $request->video_id;
    $property->video_description = $request->video_description;

    $property->save();

    return response()->json([
        'status' => 'success',
        'property_id' => $property->id,
        'message' => 'Step 4 saved successfully'
    ]);
}

    /* =========================================
       STEP 5 : AMENITIES
    ==========================================*/
  if ($step == 6) {

    // 🔥 ensure property saved
    if (!$property->id) {
        $property->save();
    }

    // =========================
    // ✅ AMENITIES
    // =========================
    $property->aminities()->sync($request->aminities ?? []);

    // =========================
    // 🔥 NEAREST LOCATIONS (MAIN FIX)
    // =========================

    // OLD DELETE
    $property->nearestLocations()->delete();

    // NEW INSERT
    if ($request->nearest_locations) {

        foreach ($request->nearest_locations as $key => $value) {

            if (!empty($value)) {

                PropertyNearestLocation::create([
                    'property_id' => $property->id,
                    'nearest_location_id' => $value,
                    'distance' => $request->distances[$key] ?? null
                ]);
            }
        }
    }

    // =========================
    // OTHER JSON FIELDS
    // =========================
    $property->club_features = $request->club_features ? json_encode($request->club_features) : null;
    $property->proximity_highlights = $request->proximity_highlights ? json_encode($request->proximity_highlights) : null;
    $property->floor_details = $request->floor_details;
    $property->ownership_type = $request->ownership_type;
    $property->is_previously_used = $request->is_previously_used ?? 0;
    $property->location_advantages = $request->location_advantages ? json_encode($request->location_advantages) : null;
    $property->fire_safety = $request->fire_safety ? json_encode($request->fire_safety) : null;
    $property->cctv_available = $request->cctv_available ?? null;
    $property->no_of_staircases = $request->no_of_staircases;
    $property->noc_certified = $request->noc_certified ?? null;
    $property->occupancy_certificate = $request->occupancy_certificate ?? null;
    $property->previously_used_for = $request->previously_used_for;

    $property->save();
}
/* =========================================
   STEP 7 : SEO ONLY
==========================================*/
if ($step == 7) {

    $property->seo_title = $request->seo_title;
    $property->seo_meta_description = $request->seo_meta_description;

    // Flags
    $property->status = 'enable';
    $property->approve_by_admin = 'approved';

    $property->is_featured = $request->has('is_featured') ? 'enable' : 'disable';
    $property->is_top      = $request->has('is_top') ? 'enable' : 'disable';
    $property->is_urgent   = $request->has('is_urgent') ? 'enable' : 'disable';

    $property->save();
}
    /* =========================================
       STEP 6 : PRICING + SEO
    ==========================================*/
if ($step == 5) {

    // =========================
    // 🔹 ADDITIONAL INFO
    // =========================
    AdditionalInformation::where('property_id', $property->id)->delete();

    if (!empty($request->add_keys)) {
        foreach ($request->add_keys as $index => $key) {

            $value = $request->add_values[$index] ?? null;

            if (!empty($key) && !empty($value)) {
                AdditionalInformation::create([
                    'property_id' => $property->id,
                    'add_key' => $key,
                    'add_value' => $value,
                ]);
            }
        }
    }

    // =========================
    // 🔥 DELETE PLANS
    // =========================
    if (!empty($request->remove_plan_ids)) {
        PropertyPlan::whereIn('id', $request->remove_plan_ids)->delete();
    }

    // =========================
    // 🔥 SAVE / UPDATE PLANS
    // =========================
    if (!empty($request->plan_titles)) {

        foreach ($request->plan_titles as $index => $title) {

            $desc = $request->plan_descriptions[$index] ?? null;
            $image = $request->file('plan_images')[$index] ?? null;
            $plan_id = $request->existing_plan_ids[$index] ?? null;

            if ($plan_id && in_array($plan_id, $request->remove_plan_ids ?? [])) {
                continue;
            }

            if (empty($title) && !$image) continue;

            $plan = $plan_id ? PropertyPlan::find($plan_id) : new PropertyPlan();

            if (!$plan) continue;

            $plan->property_id = $property->id;

            // 🔥 IMAGE
            if ($image) {

                if ($plan->image && file_exists(public_path($plan->image))) {
                    @unlink(public_path($plan->image));
                }

                $name = 'plan-' . time() . rand(100,999) . '.webp';
                $path = 'uploads/custom-images/' . $name;

                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path($path));

                $plan->image = $path;
            }

            $plan->title = $title;
            $plan->description = $desc;
            $plan->save();
        }
    }

    // =========================
    // 🔥 CONFIG JSON (FIXED)
    // =========================
   $config = json_decode($request->config_json ?? '{}', true);

if (!is_array($config)) {
    $config = [];
}
    // 🔥 SAVE RAW JSON (NO DOUBLE ENCODE ISSUE)
$property->config_json = json_encode($config, JSON_UNESCAPED_UNICODE);
    // =========================
    // 🔥 SAFE VALUE HELPER
    // =========================
    $get = function($key, $default = null) use ($config) {
        return isset($config[$key]) && $config[$key] !== '' ? $config[$key] : $default;
    };

    // =========================
    // 🔥 MAP JSON → DB
    // =========================
    $property->expected_price       = $get('expected_price');
    $property->price_per_unit       = $get('price_per_sqft');

    $property->tax_excluded         = $get('tax_excluded', 0);
    $property->tax_included         = $get('tax_included', 0);
    $property->price_negotiable     = $get('negotiable', 0);

    $property->maintenance_type     = $get('maintenance_type');
    $property->maintenance_charge   = $get('maintenance');

    $property->brokerage_required   = $get('brokerage_required', 0);
    $property->brokerage_type       = $get('brokerage_type');
    $property->brokerage_amount     = $get('brokerage_amount');

    $property->is_preleased         = $get('is_preleased', 0);
    $property->current_rent         = $get('current_rent');
    $property->lease_tenure         = $get('lease_tenure');
    $property->annual_rent_increase = $get('annual_rent_increase');
    $property->leased_to            = $get('leased_to');

    $property->pricing_description  = $get('description');

    // =========================
    // 🔥 SEO
    // =========================
   

    // =========================
    // 💾 FINAL SAVE
    // =========================
    $property->save();
}
return response()->json([
        'status' => 'success',
        'property_id' => $property->id,
        'message' => 'Step saved successfully'
    ]);
}
public function finalize(Request $request)
{
    $property = Property::findOrFail($request->property_id);

    $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:properties,slug,'.$property->id,
        'category_type' => 'required',
        'property_type_id' => 'required',
        'purpose' => 'required',
        
        'description' => 'required',
        'country_id' => 'required',
        'city_id' => 'required',
        'address' => 'required',
    ]);

    $property->approve_by_admin = 'approved';
    $property->save();

    return redirect()->route('admin.property.index')
        ->with([
            'messege' => 'Property Created Successfully',
            'alert-type' => 'success'
        ]);
}



public function getChildSubTypes($id)
{
    $childSubTypes = ChildSubPropertyType::where('sub_property_type_id', $id)
                        ->where('status', 1)
                        ->get(['id','name']);

    return response()->json($childSubTypes);
}

//     public function edit($id){

// $property = Property::findOrFail($id);
//         $types = Category::where('status', 1)->get();
//         $cities = City::all();
//         $aminities = Aminity::all();
//         $nearest_locations = NearestLocation::orderBy('id', 'desc')->where('status', 1)->get();
//         $existing_sliders = PropertySlider::where('property_id', $id)->get();
//         $existing_properties = PropertyAminity::where('property_id', $id)->get();
//         $existing_nearest_locations = PropertyNearestLocation::where('property_id', $id)->get();
//         $existing_add_informations = AdditionalInformation::where('property_id', $id)->get();
//         $existing_plans = PropertyPlan::where('property_id', $id)->get();
//         $countries = Country::orderBy('id', 'desc')->get();

//         $featured_property = 'disable';
//         $top_property = 'disable';
//         $urgent_property = 'disable';

//         if($property->agent_id == 0){
//             $featured_property = 'enable';
//             $top_property = 'enable';
//             $urgent_property = 'enable';
//         }else{
//             $agent_id = $property->agent_id;
//             $agent_order = Order::where('agent_id', $agent_id)->orderBy('id','desc')->first();

//             if($agent_order){
//                 $is_featured = $agent_order->featured_property;
//                 $featured_property_qty = $agent_order->featured_property_qty;

//                 $is_top = $agent_order->top_property;
//                 $top_property_qty = $agent_order->top_property_qty;

//                 $is_urgent = $agent_order->urgent_property;
//                 $urgent_property_qty = $agent_order->urgent_property_qty;


//                 if($top_property_qty == -1){
//                     $top_property = 'enable';
//                 }else{
//                     $top_property_count = Property::where('agent_id', $agent_id)->where('is_top', 'enable')->count();
//                     if($top_property_count < $top_property_qty){
//                         $top_property = 'enable';
//                     }
//                 }

//                 if($urgent_property_qty == -1){
//                     $urgent_property = 'enable';
//                 }else{
//                     $urgent_property_count = Property::where('agent_id', $agent_id)->where('is_urgent', 'enable')->count();
//                     if($urgent_property_count < $urgent_property_qty){
//                         $urgent_property = 'enable';
//                     }
//                 }

//                 if($featured_property_qty == -1){
//                     $featured_property = 'enable';
//                 }else{
//                     $featured_property_count = Property::where('agent_id', $agent_id)->where('is_featured', 'enable')->count();
//                     if($featured_property_count < $featured_property_qty){
//                         $featured_property = 'enable';
//                     }
//                 }
//             }else{
//                 $notification = trans('admin_validation.Agent does not have any pricing plan');
//                 $notification = array('messege'=>$notification,'alert-type'=>'error');
//                 return redirect()->back()->with($notification);
//             }
//         }

//         $setting = Setting::first();

//         return view('admin.property_edit')->with([
//             'property' => $property,
//             'types' => $types,
//             'cities' => $cities,
//             'aminities' => $aminities,
//             'nearest_locations' => $nearest_locations,
//             'existing_sliders' => $existing_sliders,
//             'existing_properties' => $existing_properties,
//             'existing_nearest_locations' => $existing_nearest_locations,
//             'existing_add_informations' => $existing_add_informations,
//             'existing_plans' => $existing_plans,
//             'featured_property' => $featured_property,
//             'top_property' => $top_property,
//             'urgent_property' => $top_property,
//             'countries' => $countries,
//             'setting' => $setting
//         ]);
//     }
public function edit($id)
{
    $property = Property::findOrFail($id);

    $types = Category::where('status', 1)->get();
    $cities = City::all();
    $aminities = Aminity::all();
    $nearest_locations = NearestLocation::where('status', 1)
                            ->orderBy('id', 'desc')
                            ->get();

    $existing_sliders = PropertySlider::where('property_id', $id)->get();
    $existing_properties = PropertyAminity::where('property_id', $id)->get();
    $existing_nearest_locations = PropertyNearestLocation::where('property_id', $id)->get();
    $existing_add_informations = AdditionalInformation::where('property_id', $id)->get();
    $existing_plans = PropertyPlan::where('property_id', $id)->get();

    $countries = Country::orderBy('id', 'desc')->get();
    $setting = Setting::first();

    // ✅ Agents for owner dropdown
    $agent_order = Order::groupBy('agent_id')->select('agent_id')->get();
    $agent_arr = [];

    foreach ($agent_order as $agent) {
        $agent_arr[] = $agent->agent_id;
    }

    $agents = User::whereIn('id', $agent_arr)
                ->select('id', 'name', 'email', 'phone')
                ->get();

    // ===============================
    // Plan Availability Logic
    // ===============================

    $featured_property = 'disable';
    $top_property = 'disable';
    $urgent_property = 'disable';

    if ($property->agent_id == 0) {

        $featured_property = 'enable';
        $top_property = 'enable';
        $urgent_property = 'enable';

    } else {

        $agent_id = $property->agent_id;

        $agent_order = Order::where('agent_id', $agent_id)
                            ->orderBy('id', 'desc')
                            ->first();

        if (!$agent_order) {
            return redirect()->back()->with([
                'messege' => trans('admin_validation.Agent does not have any pricing plan'),
                'alert-type' => 'error'
            ]);
        }

        // ===== TOP PROPERTY =====
        if ($agent_order->top_property_qty == -1) {
            $top_property = 'enable';
        } else {
            $top_count = Property::where('agent_id', $agent_id)
                        ->where('is_top', 'enable')
                        ->count();

            if ($top_count < $agent_order->top_property_qty) {
                $top_property = 'enable';
            }
        }

        // ===== URGENT PROPERTY =====
        if ($agent_order->urgent_property_qty == -1) {
            $urgent_property = 'enable';
        } else {
            $urgent_count = Property::where('agent_id', $agent_id)
                        ->where('is_urgent', 'enable')
                        ->count();

            if ($urgent_count < $agent_order->urgent_property_qty) {
                $urgent_property = 'enable';
            }
        }

        // ===== FEATURED PROPERTY =====
        if ($agent_order->featured_property_qty == -1) {
            $featured_property = 'enable';
        } else {
            $featured_count = Property::where('agent_id', $agent_id)
                        ->where('is_featured', 'enable')
                        ->count();

            if ($featured_count < $agent_order->featured_property_qty) {
                $featured_property = 'enable';
            }
        }
    }

    return view('admin.property_create', [
        'property' => $property,
        'types' => $types,
        'cities' => $cities,
        'aminities' => $aminities,
        'nearest_locations' => $nearest_locations,
        'existing_sliders' => $existing_sliders,
        'existing_properties' => $existing_properties,
        'existing_nearest_locations' => $existing_nearest_locations,
        'existing_add_informations' => $existing_add_informations,
        'existing_plans' => $existing_plans,
        'featured_property' => $featured_property,
        'top_property' => $top_property,
        'urgent_property' => $urgent_property, // ✅ FIXED
        'countries' => $countries,
        'setting' => $setting,
        'agents' => $agents // ✅ IMPORTANT
    ]);
}
    // public function update(Request $request, $id){

    //     $property = Property::find($id);
    //     $live_map = Setting::first()->live_map;

    //     $rules = [
    //         'title'=>'required|unique:properties,title,'.$id,
    //         'slug'=>'required|unique:properties,slug,'.$id,
    //         'property_type_id'=>'required',
    //         'purpose'=> 'required',
    //         'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
    //         'price'=>'required',
    //         'description'=>'required',
    //         'country_id'=>'required',
    //         'city_id'=>'required',
    //         'address'=>'required',
    //         'address_description'=>'required',
    //         'google_map'=> $live_map == 'no' ? 'required' : '',
    //         'total_area'=>'required',
    //         'total_unit'=>'required',
    //         'total_bedroom'=>'required',
    //         'total_bathroom'=>'required',
    //         'total_garage'=>'required',
    //         'total_kitchen'=>'required',
    //     ];

    //     if ($request->lang_code !== 'en') {
    //         $rules = [
    //             'title' => 'required|unique:properties,title,' . $id,
    //             'description' => 'required',
    //             'address'=>'required',
    //             'address_description' => 'required',
    //         ];
    //     }

    //     $customMessages = [
    //         'title.required' => trans('admin_validation.Title is required'),
    //         'title.unique' => trans('admin_validation.Title already exist'),
    //         'slug.required' => trans('admin_validation.Slug is required'),
    //         'slug.unique' => trans('admin_validation.Slug already exist'),
    //         'property_type_id.required' => trans('admin_validation.Property type is required'),
    //         'purpose.required' => trans('admin_validation.Purpose is required'),
    //         'rent_period.required' => trans('admin_validation.Rent period is required'),
    //         'price.required' => trans('admin_validation.Price is required'),
    //         'description.required' => trans('admin_validation.Description is required'),
    //         'country_id.required' => trans('admin_validation.Country is required'),
    //         'city_id.required' => trans('admin_validation.City is required'),
    //         'address.required' => trans('admin_validation.Address is required'),
    //         'address_description.required' => trans('admin_validation.Address details is required'),
    //         'google_map.required' => trans('admin_validation.Google map is required'),
    //         'total_area.required' => trans('admin_validation.Total area is required'),
    //         'total_unit.required' => trans('admin_validation.Total unit is required'),
    //         'total_bedroom.required' => trans('admin_validation.Total bedroom is required'),
    //         'total_bathroom.required' => trans('admin_validation.Total bathroom is required'),
    //         'total_garage.required' => trans('admin_validation.Total garage is required'),
    //         'total_kitchen.required' => trans('admin_validation.Total kitchen is required'),
    //     ];

    //     $this->validate($request, $rules,$customMessages);

    //     /* -------Dynamicly Update------*/


    //     if ($request->lang_code !== 'en') {
    //         updateOrCreateTransaltion($request, $property);
    //     }

    //     $property->title = $request->title;
    //     $property->description = $request->description;
    //     $property->video_description = $request->video_description;
    //     $property->address = $request->address;
    //     $property->address_description = $request->address_description;
    //     $property->seo_title = $request->seo_title ? $request->seo_title : $request->title;
    //     $property->seo_meta_description = $request->seo_meta_description ? $request->seo_meta_description : $request->title;

    //     $property->slug = $request->slug;
    //     $property->property_type_id = $request->property_type_id;
    //     $property->purpose = $request->purpose;
    //     $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : '';
    //     $property->price = $request->price;

    //     $property->total_area = $request->total_area;
    //     $property->total_unit = $request->total_unit;
    //     $property->total_bedroom = $request->total_bedroom;
    //     $property->total_bathroom = $request->total_bathroom;
    //     $property->total_garage = $request->total_garage;
    //     $property->total_kitchen = $request->total_kitchen;
    //     $property->total_bathroom = $request->total_bathroom;

    //     $property->country_id = $request->country_id;
    //     $property->city_id = $request->city_id;
    //     $property->google_map = $request->google_map;
    //     $property->lat = $request->has('lat') ? $request->lat : $property->lat;
    //     $property->lon = $request->has('lng') ? $request->lng : $property->lon;

    //     $property->video_id = $request->video_id;

    //     if($request->thumbnail_image && $request->lang_code === 'en'){
    //         $old_thumbnail_image = $property->thumbnail_image;
    //         $extention = $request->thumbnail_image->getClientOriginalExtension();
    //         $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //         $image_name = 'uploads/custom-images/'.$image_name;



    //         Image::make($request->thumbnail_image)
    //             ->encode('webp', 80)
    //             ->save(public_path().'/'.$image_name);

    //         $property->thumbnail_image = $image_name;
    //         $property->save();

    //         if($old_thumbnail_image){
    //             if(File::exists(public_path().'/'.$old_thumbnail_image))unlink(public_path().'/'.$old_thumbnail_image);
    //         }
    //     }

    //     if($request->video_thumbnail && $request->lang_code === 'en'){
    //         $old_video_thumbnail = $property->video_thumbnail;
    //         $extention = $request->video_thumbnail->getClientOriginalExtension();
    //         $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //         $image_name = 'uploads/custom-images/'.$image_name;
    //         Image::make($request->video_thumbnail)
    //             ->encode('webp', 80)
    //             ->save(public_path().'/'.$image_name);
    //         $property->video_thumbnail = $image_name;

    //         if($old_video_thumbnail){
    //             if(File::exists(public_path().'/'.$old_video_thumbnail))unlink(public_path().'/'.$old_video_thumbnail);
    //         }
    //     }


    //         $property->status = $request->status ? 'enable' : 'disable';
    //         $property->is_featured = $request->is_featured ? 'enable' : 'disable';
    //         $property->is_top = $request->is_top ? 'enable' : 'disable';
    //         $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';



    //     if($property->agent_id != 0){
    //         $property->approve_by_admin = $request->approve_by_admin;
    //     }
    //     $property->date_from = $request->date_form;
    //     $property->date_to = $request->date_to;
    //     $property->time_from = $request->time_form;
    //     $property->time_to = $request->time_to;

    //     if ($request->lang_code === 'en') {
    //         $property->save();
    //     }

    //     PropertyAminity::where('property_id', $id)->delete();

    //     if($request->aminities && $request->lang_code === 'en'){
    //         foreach($request->aminities as $aminity){
    //             $item = new PropertyAminity();
    //             $item->aminity_id = $aminity;
    //             $item->property_id = $property->id;
    //             $item->save();
    //         }
    //     }

    //     if($request->slider_images && $request->lang_code === 'en'){
    //         foreach($request->slider_images as $index => $image){
    //             $extention = $image->getClientOriginalExtension();
    //             $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //             $image_name = 'uploads/custom-images/'.$image_name;
    //             Image::make($image)
    //                 ->encode('webp', 80)
    //                 ->save(public_path().'/'.$image_name);

    //             $slider = new PropertySlider();
    //             $slider->property_id = $property->id;
    //             $slider->image = $image_name;
    //             $slider->save();
    //         }
    //     }

    //     if($request->existing_nearest_locations && $request->existing_distances && ($request->lang_code === 'en')){
    //         foreach($request->existing_nearest_locations as $index => $nearest_location){
    //             if($request->existing_nearest_locations[$index] != '' && $request->existing_distances[$index] != '' && $request->existing_nearest_ids[$index] != ''){
    //                 $new_loc = PropertyNearestLocation::find($request->existing_nearest_ids[$index]);
    //                 $new_loc->nearest_location_id = $request->existing_nearest_locations[$index];
    //                 $new_loc->distance = $request->existing_distances[$index];
    //                 $new_loc->save();
    //             }
    //         }
    //     }

    //     if($request->nearest_locations && $request->distances && ($request->lang_code === 'en')){
    //         foreach($request->nearest_locations as $index => $nearest_location){
    //             if($request->nearest_locations[$index] != '' && $request->distances[$index] != ''){
    //                 $new_loc = new PropertyNearestLocation();
    //                 $new_loc->property_id = $property->id;
    //                 $new_loc->nearest_location_id = $request->nearest_locations[$index];
    //                 $new_loc->distance = $request->distances[$index];
    //                 $new_loc->save();
    //             }
    //         }
    //     }

    //     if($request->existing_add_keys && $request->existing_add_values){
    //         foreach($request->existing_add_keys as $index => $add_key){
    //             if($request->existing_add_keys[$index] != '' && $request->existing_add_values[$index] != '' && $request->existing_add_ids[$index] != ''){
    //                 $new_loc = AdditionalInformation::find($request->existing_add_ids[$index]);

    //                 if ($request->lang_code !== 'en') {
    //                     $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->existing_add_keys[$index]);

    //                     $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->existing_add_values[$index]);
    //                 } else {
    //                     $new_loc->add_key = $request->existing_add_keys[$index];
    //                     $new_loc->add_value = $request->existing_add_values[$index];
    //                     $new_loc->save();
    //                 }



    //             }
    //         }
    //     }

    //     if($request->add_keys && $request->add_values){
    //         foreach($request->add_keys as $index => $add_key){
    //             if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
    //                 $new_loc = new AdditionalInformation();
    //                 $new_loc->property_id = $property->id;



    //                 if ($request->lang_code !== 'en') {
    //                     $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->add_keys[$index]);

    //                     $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->add_values[$index]);
    //                 } else {
    //                     $new_loc->add_key = $request->add_keys[$index];
    //                     $new_loc->add_value = $request->add_values[$index];
    //                     $new_loc->save();
    //                 }



    //             }
    //         }
    //     }

    //     if($request->existing_plan_ids && $request->existing_plan_titles && $request->existing_plan_descriptions){
    //         foreach($request->existing_plan_ids as $index => $plan_id){

    //             if($request->existing_plan_ids[$index] && $request->existing_plan_titles[$index] && $request->existing_plan_descriptions[$index]){

    //                 $plan = PropertyPlan::find($request->existing_plan_ids[$index]);
    //                 if ($request->lang_code !== 'en') {

    //                     $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->existing_plan_titles[$index]);

    //                     $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->existing_plan_descriptions[$index]);

    //                 } else {
    //                     $plan->title = $request->existing_plan_titles[$index];
    //                     $plan->description = $request->existing_plan_descriptions[$index];
    //                     $plan->save();
    //                 }



    //                 $ex_name = 'existing_plan_image_'.$plan_id;
    //                 $request_exist_image = $request->$ex_name;

    //                 if($request_exist_image && ($request->lang_code === 'en')){
    //                     $exist_image = $plan->image;
    //                     $extention = $request_exist_image->getClientOriginalExtension();
    //                     $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //                     $image_name = 'uploads/custom-images/'.$image_name;
    //                     Image::make($request_exist_image)
    //                         ->encode('webp', 80)
    //                         ->save(public_path().'/'.$image_name);

    //                     $plan->image = $image_name;
    //                     $plan->save();
    //                     if($exist_image){
    //                         if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
    //                     }
    //                 }

    //             }
    //         }
    //     }

    //     if($request->plan_images && $request->plan_titles && $request->plan_descriptions){
    //         foreach($request->plan_images as $index => $image){
    //             if($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]){
    //                 $extention = $image->getClientOriginalExtension();
    //                 $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
    //                 $image_name = 'uploads/custom-images/'.$image_name;

    //                 if($request->lang_code === 'en'){
    //                     Image::make($image)
    //                     ->encode('webp', 80)
    //                     ->save(public_path().'/'.$image_name);
    //                 }

    //                 $plan = new PropertyPlan();
    //                 $plan->property_id = $property->id;
    //                 $plan->image = $image_name;

    //                 if ($request->lang_code !== 'en') {

    //                     $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->plan_titles[$index]);

    //                     $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->plan_descriptions[$index]);
    //                 } else {
    //                     $plan->title = $request->plan_titles[$index];
    //                     $plan->description = $request->plan_descriptions[$index];
    //                     $plan->save();
    //                 }





    //             }
    //         }
    //     }

    //     if($property->agent_id != 0){
    //         $notification = trans('admin_validation.Update succssfully');
    //         $notification = array('messege'=>$notification,'alert-type'=>'success');
    //         return redirect()->back('admin.agent-property')->with($notification);
    //     }else{
    //         $notification = trans('admin_validation.Update succssfully');
    //         $notification = array('messege'=>$notification,'alert-type'=>'success');
    //         return redirect()->back()->with($notification);
    //     }



    // }

public function update(Request $request, $id){

    $property = Property::find($id);
    $live_map = Setting::first()->live_map;

    $rules = [
        'title'=>'required|unique:properties,title,'.$id,
        'slug'=>'required|unique:properties,slug,'.$id,

        // âœ… NEW
        'category_type'=>'required',
        'sub_property_type_id'=>'nullable',

        'property_type_id'=>'required',
        'purpose'=> 'required',
        'rent_period'=> $request->purpose == 'rent' ? 'required' : '',
        'price'=>'required',
        'description'=>'required',
        'country_id'=>'required',
        'city_id'=>'required',
        'address'=>'required',
        'address_description'=>'required',
        'google_map'=> $live_map == 'no' ? 'required' : '',
        'total_area'=>'required',
        'total_unit'=>'required',
        'total_bedroom'=>'required',
        'total_bathroom'=>'required',
        'total_garage'=>'required',
        'total_kitchen'=>'required',
    ];

    if ($request->lang_code !== 'en') {
        $rules = [
            'title' => 'required|unique:properties,title,' . $id,
            'description' => 'required',
            'address'=>'required',
            'address_description' => 'required',
        ];
    }

    $this->validate($request, $rules);

    /* âœ… STRICT SUB TYPE CHECK */
    if($request->sub_property_type_id){
        $check = SubPropertyType::where('id',$request->sub_property_type_id)
            ->where('category_id',$request->property_type_id) // ðŸ”¥ change here
                ->exists();

        if(!$check){
            return back()->withErrors([
                'sub_property_type_id'=>'Invalid Sub Property Type'
            ]);
        }
    }

    /* -------Dynamicly Update------*/

    if ($request->lang_code !== 'en') {
        updateOrCreateTransaltion($request, $property);
    }

    $property->title = $request->title;
    $property->description = $request->description;
    $property->video_description = $request->video_description;
    $property->address = $request->address;
    $property->address_description = $request->address_description;
    $property->seo_title = $request->seo_title ? $request->seo_title : $request->title;
    $property->seo_meta_description = $request->seo_meta_description ? $request->seo_meta_description : $request->title;

    $property->slug = $request->slug;

    /* âœ… NEW FIELDS STORED */
    $property->category_type = $request->category_type;
    $property->property_type_id = $request->property_type_id;
    $property->sub_property_type_id = $request->sub_property_type_id;

    $property->purpose = $request->purpose;
    $property->rent_period = $request->purpose == 'rent' ? $request->rent_period : '';
    $property->price = $request->price;

    $property->total_area = $request->total_area;
    $property->total_unit = $request->total_unit;
    $property->total_bedroom = $request->total_bedroom;
    $property->total_bathroom = $request->total_bathroom;
    $property->total_garage = $request->total_garage;
    $property->total_kitchen = $request->total_kitchen;

    $property->country_id = $request->country_id;
    $property->city_id = $request->city_id;
    $property->google_map = $request->google_map;
    $property->lat = $request->has('lat') ? $request->lat : $property->lat;
    $property->lon = $request->has('lng') ? $request->lng : $property->lon;

    $property->video_id = $request->video_id;

    /* ===== REST OF YOUR CODE EXACT SAME ===== */

    if($request->thumbnail_image && $request->lang_code === 'en'){
        $old_thumbnail_image = $property->thumbnail_image;
        $image_name = 'property-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
        $image_name = 'uploads/custom-images/'.$image_name;

        Image::make($request->thumbnail_image)
            ->encode('webp', 80)
            ->save(public_path().'/'.$image_name);

        $property->thumbnail_image = $image_name;

        if($old_thumbnail_image){
            if(File::exists(public_path().'/'.$old_thumbnail_image))
                unlink(public_path().'/'.$old_thumbnail_image);
        }
    }

    if($request->video_thumbnail && $request->lang_code === 'en'){
        $old_video_thumbnail = $property->video_thumbnail;
        $image_name = 'video-thumb'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
        $image_name = 'uploads/custom-images/'.$image_name;

        Image::make($request->video_thumbnail)
            ->encode('webp', 80)
            ->save(public_path().'/'.$image_name);

        $property->video_thumbnail = $image_name;

        if($old_video_thumbnail){
            if(File::exists(public_path().'/'.$old_video_thumbnail))
                unlink(public_path().'/'.$old_video_thumbnail);
        }
    }

    $property->status = $request->status ? 'enable' : 'disable';
    $property->is_featured = $request->is_featured ? 'enable' : 'disable';
    $property->is_top = $request->is_top ? 'enable' : 'disable';
    $property->is_urgent = $request->is_urgent ? 'enable' : 'disable';

    if($property->agent_id != 0){
        $property->approve_by_admin = $request->approve_by_admin;
    }

    $property->date_from = $request->date_form;
    $property->date_to = $request->date_to;
    $property->time_from = $request->time_form;
    $property->time_to = $request->time_to;

    if ($request->lang_code === 'en') {
        $property->save();
    }

            PropertyAminity::where('property_id', $id)->delete();

        if($request->aminities && $request->lang_code === 'en'){
            foreach($request->aminities as $aminity){
                $item = new PropertyAminity();
                $item->aminity_id = $aminity;
                $item->property_id = $property->id;
                $item->save();
            }
        }

        if($request->slider_images && $request->lang_code === 'en'){
            foreach($request->slider_images as $index => $image){
                $extention = $image->getClientOriginalExtension();
                $image_name = 'Property-slider'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                $image_name = 'uploads/custom-images/'.$image_name;
                Image::make($image)
                    ->encode('webp', 80)
                    ->save(public_path().'/'.$image_name);

                $slider = new PropertySlider();
                $slider->property_id = $property->id;
                $slider->image = $image_name;
                $slider->save();
            }
        }

        if($request->existing_nearest_locations && $request->existing_distances && ($request->lang_code === 'en')){
            foreach($request->existing_nearest_locations as $index => $nearest_location){
                if($request->existing_nearest_locations[$index] != '' && $request->existing_distances[$index] != '' && $request->existing_nearest_ids[$index] != ''){
                    $new_loc = PropertyNearestLocation::find($request->existing_nearest_ids[$index]);
                    $new_loc->nearest_location_id = $request->existing_nearest_locations[$index];
                    $new_loc->distance = $request->existing_distances[$index];
                    $new_loc->save();
                }
            }
        }

        if($request->nearest_locations && $request->distances && ($request->lang_code === 'en')){
            foreach($request->nearest_locations as $index => $nearest_location){
                if($request->nearest_locations[$index] != '' && $request->distances[$index] != ''){
                    $new_loc = new PropertyNearestLocation();
                    $new_loc->property_id = $property->id;
                    $new_loc->nearest_location_id = $request->nearest_locations[$index];
                    $new_loc->distance = $request->distances[$index];
                    $new_loc->save();
                }
            }
        }

        if($request->existing_add_keys && $request->existing_add_values){
            foreach($request->existing_add_keys as $index => $add_key){
                if($request->existing_add_keys[$index] != '' && $request->existing_add_values[$index] != '' && $request->existing_add_ids[$index] != ''){
                    $new_loc = AdditionalInformation::find($request->existing_add_ids[$index]);

                    if ($request->lang_code !== 'en') {
                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->existing_add_keys[$index]);

                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->existing_add_values[$index]);
                    } else {
                        $new_loc->add_key = $request->existing_add_keys[$index];
                        $new_loc->add_value = $request->existing_add_values[$index];
                        $new_loc->save();
                    }



                }
            }
        }

        if($request->add_keys && $request->add_values){
            foreach($request->add_keys as $index => $add_key){
                if($request->add_keys[$index] != '' && $request->add_values[$index] != ''){
                    $new_loc = new AdditionalInformation();
                    $new_loc->property_id = $property->id;



                    if ($request->lang_code !== 'en') {
                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_key', $request->add_keys[$index]);

                        $new_loc->updateOrCreateTranslation($request->lang_code, 'add_value', $request->add_values[$index]);
                    } else {
                        $new_loc->add_key = $request->add_keys[$index];
                        $new_loc->add_value = $request->add_values[$index];
                        $new_loc->save();
                    }



                }
            }
        }

        if($request->existing_plan_ids && $request->existing_plan_titles && $request->existing_plan_descriptions){
            foreach($request->existing_plan_ids as $index => $plan_id){

                if($request->existing_plan_ids[$index] && $request->existing_plan_titles[$index] && $request->existing_plan_descriptions[$index]){

                    $plan = PropertyPlan::find($request->existing_plan_ids[$index]);
                    if ($request->lang_code !== 'en') {

                        $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->existing_plan_titles[$index]);

                        $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->existing_plan_descriptions[$index]);

                    } else {
                        $plan->title = $request->existing_plan_titles[$index];
                        $plan->description = $request->existing_plan_descriptions[$index];
                        $plan->save();
                    }



                    $ex_name = 'existing_plan_image_'.$plan_id;
                    $request_exist_image = $request->$ex_name;

                    if($request_exist_image && ($request->lang_code === 'en')){
                        $exist_image = $plan->image;
                        $extention = $request_exist_image->getClientOriginalExtension();
                        $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                        $image_name = 'uploads/custom-images/'.$image_name;
                        Image::make($request_exist_image)
                            ->encode('webp', 80)
                            ->save(public_path().'/'.$image_name);

                        $plan->image = $image_name;
                        $plan->save();
                        if($exist_image){
                            if(File::exists(public_path().'/'.$exist_image))unlink(public_path().'/'.$exist_image);
                        }
                    }

                }
            }
        }

        if($request->plan_images && $request->plan_titles && $request->plan_descriptions){
            foreach($request->plan_images as $index => $image){
                if($request->plan_images[$index] && $request->plan_titles[$index] && $request->plan_descriptions[$index]){
                    $extention = $image->getClientOriginalExtension();
                    $image_name = 'Property-plan'.date('-Y-m-d-h-i-s-').rand(999,9999).'.webp';
                    $image_name = 'uploads/custom-images/'.$image_name;

                    if($request->lang_code === 'en'){
                        Image::make($image)
                        ->encode('webp', 80)
                        ->save(public_path().'/'.$image_name);
                    }

                    $plan = new PropertyPlan();
                    $plan->property_id = $property->id;
                    $plan->image = $image_name;

                    if ($request->lang_code !== 'en') {

                        $plan->updateOrCreateTranslation($request->lang_code, 'title', $request->plan_titles[$index]);

                        $plan->updateOrCreateTranslation($request->lang_code, 'description', $request->plan_descriptions[$index]);
                    } else {
                        $plan->title = $request->plan_titles[$index];
                        $plan->description = $request->plan_descriptions[$index];
                        $plan->save();
                    }





                }
            }
        }

        if($property->agent_id != 0){
            $notification = trans('admin_validation.Update succssfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back('admin.agent-property')->with($notification);
        }else{
            $notification = trans('admin_validation.Update succssfully');
            $notification = array('messege'=>$notification,'alert-type'=>'success');
            return redirect()->back()->with($notification);
        }


}
    public function destroy($id){

        $property = Property::find($id);
        $property->deleteAllTranslations();
        PropertyAminity::where('property_id', $id)->delete();
        PropertyNearestLocation::where('property_id', $id)->delete();
        AdditionalInformation::where('property_id', $id)->delete();
        Wishlist::where('property_id', $id)->delete();
        Compare::where('property_id', $id)->delete();
        Review::where('property_id', $id)->delete();



        $existing_plans = PropertyPlan::where('property_id', $id)->get();

        foreach($existing_plans as $existing_plan){
            $old_image = $existing_plan->image;
            if($old_image){
                if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
            }
            $existing_plan->delete();
        }

        $existing_sliders = PropertySlider::where('property_id', $id)->get();

        foreach($existing_sliders as $existing_slider){
            $old_slider = $existing_slider->image;
            if($old_slider){
                if(File::exists(public_path().'/'.$old_slider))unlink(public_path().'/'.$old_slider);
            }
            $existing_slider->delete();
        }


        $old_thumbnail_image = $property->thumbnail_image;
        if($old_thumbnail_image){
            if(File::exists(public_path().'/'.$old_thumbnail_image))unlink(public_path().'/'.$old_thumbnail_image);
        }

        $old_video_thumbnail = $property->video_thumbnail;
        if($old_video_thumbnail){
            if(File::exists(public_path().'/'.$old_video_thumbnail))unlink(public_path().'/'.$old_video_thumbnail);
        }

        $property->delete();

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }


    public function remove_property_slider($id){
        $slider = PropertySlider::where('id', $id)->first();

        $old_slider = $slider->image;
        if($old_slider){
            if(File::exists(public_path().'/'.$old_slider))unlink(public_path().'/'.$old_slider);
        }

        $slider->delete();

        return response()->json(['message' => 'success']);

    }

public function getPropertyTypes($category)
{
    $types = Category::where('category_type', $category)
                ->where('status',1)
                ->get();

    return response()->json($types);
}

public function getSubTypes($type)
{
    $subTypes = SubPropertyType::where('category_id', $type)
                    ->where('status',1)
                    ->get();

    return response()->json($subTypes);
}



    public function remove_nearest_location($id){
        PropertyNearestLocation::where('id', $id)->delete();

        return response()->json(['message' => 'success']);
    }

    public function remove_add_info($id){
        AdditionalInformation::where('id', $id)->delete();

        return response()->json(['message' => 'success']);
    }

    public function remove_plan($id){
        $plan = PropertyPlan::where('id', $id)->first();

        $old_image = $plan->image;
        if($old_image){
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $plan->delete();

        return response()->json(['message' => 'success']);

    }

    public function check_slug($slug){
        $property = Property::where('slug', $slug)->first();
        if($property){
            return response()->json(['message' => trans('admin_validation.Slug already exist')],403);
        }else{
            return response()->json(['message' => 'available']);
        }
    }

    public function agent_plan_availability($agent_id){

        $agent_order = Order::where('agent_id', $agent_id)->orderBy('id','desc')->first();

        if($agent_order){

            $available = 'disable';
            $top_property = 'disable';
            $urgent_property = 'disable';

            $expiration_date = $agent_order->expiration_date;

            if($expiration_date != 'lifetime'){
                if(date('Y-m-d') > $expiration_date){
                    return response()->json(['message' => trans('admin_validation.Pricing plan date is expired'), 'available' => 'disable', 'top_property' => 'disable', 'urgent_property' => 'disable', 'featured_property' => 'disable'],403);
                }
            }

            $number_of_property = $agent_order->number_of_property;

            $is_featured = $agent_order->featured_property;
            $featured_property_qty = $agent_order->featured_property_qty;

            $is_top = $agent_order->top_property;
            $top_property_qty = $agent_order->top_property_qty;

            $is_urgent = $agent_order->urgent_property;
            $urgent_property_qty = $agent_order->urgent_property_qty;

            if($number_of_property == -1){
                $available = 'enable';
            }else{
                $property_count = Property::where('agent_id', $agent_id)->count();
                if($property_count < $number_of_property){
                    $available = 'enable';
                }
            }

            if($top_property_qty == -1){
                $top_property = 'enable';
            }else{
                $top_property_count = Property::where('agent_id', $agent_id)->where('is_top', 'enable')->count();
                if($top_property_count < $top_property_qty){
                    $top_property = 'enable';
                }
            }

            if($urgent_property_qty == -1){
                $urgent_property = 'enable';
            }else{
                $urgent_property_count = Property::where('agent_id', $agent_id)->where('is_urgent', 'enable')->count();
                if($urgent_property_count < $urgent_property_qty){
                    $urgent_property = 'enable';
                }
            }

            $featured_property = 'disable';
            if($featured_property_qty == -1){
                $featured_property = 'enable';
            }else{
                $featured_property_count = Property::where('agent_id', $agent_id)->where('is_featured', 'enable')->count();
                if($featured_property_count < $featured_property_qty){
                    $featured_property = 'enable';
                }
            }

            return response()->json(['message' => 'success' ,'available' => $available , 'top_property' => $top_property, 'urgent_property' => $urgent_property, 'featured_property' => $featured_property]);

        }else{
            return response()->json(['message' => trans('admin_validation.Agent does not have any pricing plan'), 'available' => 'disable', 'top_property' => 'disable', 'urgent_property' => 'disable', 'featured_property' => 'disable'],403);
        }

    }


    public function assign_slider_property(){
        $properties = Property::where('status', 'enable')->get();

        return view('admin.assign_slider_property', compact('properties'));
    }

    public function store_assign_slider_property(Request $request){

        $rules = [
            'property_id'=>'required',
            'serial'=>'required',
        ];

        $customMessages = [
            'property_id.required' => trans('admin_validation.Property is required'),
            'serial.required' => trans('admin_validation.Serial is required'),
        ];

        $this->validate($request, $rules,$customMessages);

        $property = Property::find($request->property_id);

        $count = Property::where('id', $request->property_id)->where('show_slider', 'enable')->count();

        if($count > 0){
            $notification=trans('admin_validation.Property already assign');
            $notification=array('messege'=>$notification,'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }

        $property->show_slider = 'enable';
        $property->serial = $request->serial;
        $property->save();

        $notification=trans('admin_validation.Assign successful');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function remove_intro_slider($id){

        $property = Property::find($id);
        $property->show_slider = 'disable';
        $property->serial = 0;
        $property->save();

        $notification=trans('admin_validation.Deleted successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function review_list(Request $request){
        if($request->agent_id){
            $reviews = Review::orderBy('id','desc')->where('agent_id', $request->agent_id)->get();
        }else{
            $reviews = Review::orderBy('id','desc')->get();
        }


        return view('admin.review', compact('reviews'));
    }

    public function show_review($id){
        $review = Review::find($id);

        return view('admin.show_review', compact('review'));
    }

    public function update_review(Request $request, $id){
        $review = Review::find($id);
        $review->status = $request->status;
        $review->save();

        $notification=trans('admin_validation.Updated successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function delete_review($id){
        $review = Review::find($id);
        $review->delete();

        $notification=trans('admin_validation.Deleted successfully');
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->route('admin.review-list')->with($notification);

    }


    public function Booking()
    {

        $booking = Booking::with('property')->where('agent_id', 0)->paginate(10);

        return view('admin.booking')->with(['booking' => $booking]);
    }

    public function showBooking($id){
        $booking = Booking::where('id', $id)->first();
        return view('admin.booking_show')->with(['booking' => $booking]);
    }

    public function changeStatus($id){
        $Booking = Booking::find($id);
        if($Booking->status==1){
            $Booking->status=0;
            $Booking->save();
            $message= trans('admin_validation.Pending Successfully');
        }else{
            $Booking->status=1;
            $Booking->save();
            $message= trans('admin_validation.Confirmed Successfully');
        }
        return response()->json($message);
    }

    public function remove($id)
    {
        $Booking = Booking::find($id);
        $Booking->delete();

        $notification = trans('admin_validation.Deleted successfully');
        $notification = array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function property_city_list(Request $request, $id)
    {
        $cities = City::where('country_id', $id)->orderBY('name', 'asc')->get();
        $city_id = $request->city_id ?? null;

        return response()->json([
            'template' => view('admin.city_partials', compact('cities', 'city_id'))->render()
        ], 200);
    }

public function getStates($country_id)
{
    $states = \App\Models\State::where('country_id', $country_id)->get();
    return response()->json($states);
}

public function getCities($state_id)
{
    $cities = \App\Models\City::where('state_id', $state_id)->get();
    return response()->json($cities);
}
}
