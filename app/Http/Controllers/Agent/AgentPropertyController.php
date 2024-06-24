<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class AgentPropertyController extends Controller
{
    public function AgentAllProperty(){

        $id = Auth::user()->id;
        $property = Property::where('agent_id',$id)->latest()->get();
        return view('agent.property.all_property',compact('property'));

    } // End Method
    public function AgentAddProperty(){

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.add_property', compact('propertytype','amenities'));
    }

    public function AgentStoreProperty(Request $request){

        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);
        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        if ($request->file('property_thumbnail')) {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('property_thumbnail')->getClientOriginalExtension();
            $img = $manager->read($request->file('property_thumbnail'));
            $img = $img->resize(370,250);

            $img->toJpeg(80)->save(base_path('public/upload/property/thumbnail/'.$name_gen));
            $save_url = 'upload/property/thumbnail/'.$name_gen;
        }


        $property_id = Property::insertGetId([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_thumbnail' => $save_url,
            'property_status' => $request->property_status,
            'rental_price' => $request->rental_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'property_video' => $request->property_video,
            'short_desc' => $request->short_desc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'agent_id' => Auth::user()->id,
            'state' => $request->state,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            if ($img) {
                $manager = new ImageManager(new Driver());
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $image = $manager->read($img);
                $image = $image->resize(770, 520);
                $image->toJpeg(80)->save(base_path('public/upload/property/multi_img/' . $make_name));
                $uploadPath = 'upload/property/multi_img/'.$make_name;
            }


            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $facilities = Count($request->facility_name);
        if ($facilities != NULL) {
           for ($i=0; $i < $facilities; $i++) {
               $fcount = new Facility();
               $fcount->property_id = $property_id;
               $fcount->facility_name = $request->facility_name[$i];
               $fcount->distance = $request->distance[$i];
               $fcount->save();
           }
        }

         /// End Facilities  ////


            $notification = array(
            'message' => 'Property Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.all.property')->with($notification);

    }

    public function AgentEditProperty($id){

        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(',', $type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        return view('agent.property.edit_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'));

    }


    public function AgentUpdateProperty(Request $request){

        $amen = $request->amenities_id;
        $amenities = implode(",", $amen);

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([

            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenities,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_status' => $request->property_status,
            'rental_price' => $request->rental_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'property_video' => $request->property_video,
            'short_desc' => $request->short_desc,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'agent_id' => Auth::user()->id,
            'state' => $request->state,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentUpdatePropertyThumbnail(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        // Check if a file was uploaded
        if ($request->hasFile('property_thumbnail')) {
            $image = $request->file('property_thumbnail');

            // Generate a unique name for the image
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Resize and save the image
            $image->resize(370, 250)->save(public_path('upload/property/thumbnail/' . $name_gen));

            // Construct the URL for the saved image
            $save_url = 'upload/property/thumbnail/' . $name_gen;

            // Delete the old image if it exists
            if (file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            // Update the property with the new thumbnail URL
            Property::findOrFail($pro_id)->update([
                'property_thumbnail' => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            // Redirect back with success notification
            $notification = [
                'message' => 'Property Image Thumbnail Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            // If no file was uploaded, redirect back with error notification
            $notification = [
                'message' => 'No image uploaded.',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function AgentUpdatePropertyMultiimage(Request $request)
{
    $imgs = $request->multi_img;
    foreach($imgs as $id => $img) {
            if ($img) {
                $manager = new ImageManager(new Driver());
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $image = $manager->read($img);
                $image = $image->resize(770, 520);
                $image->toJpeg(80)->save(base_path('public/upload/property/multi_img/' . $make_name));
                $uploadPath = 'upload/property/multi_img/'.$make_name;
            }
            // Update the MultiImage record with the new photo name
            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

}
public function AgentPropertyMultiImageDelete($id){

    $oldImg = MultiImage::findOrFail($id);
    unlink($oldImg->photo_name);

    MultiImage::findOrFail($id)->delete();

    $notification = array(
        'message' => 'Property Multi Image Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}
public function AgentStoreNewMultiimage(Request $request){

    $new_multi = $request->imageid;
    $image = $request->file('multi_img');

    if ($image) {
        $manager = new ImageManager(new Driver());
        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image = $manager->read($image);
        $image = $image->resize(770, 520);
        $image->toJpeg(80)->save(base_path('public/upload/property/multi_img/' . $make_name));
        $uploadPath = 'upload/property/multi_img/'.$make_name;
    }

    MultiImage::insert([
        'property_id' => $new_multi,
        'photo_name' => $uploadPath,
        'created_at' => Carbon::now(),
    ]);

$notification = array(
        'message' => 'Property Multi Image Added Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);


}
public function AgentUpdatePropertyFacilities(Request $request){

    $pid = $request->id;

    if ($request->facility_name == NULL) {
       return redirect()->back();
    }else{
        Facility::where('property_id',$pid)->delete();

      $facilities = Count($request->facility_name);

       for ($i=0; $i < $facilities; $i++) {
           $fcount = new Facility();
           $fcount->property_id = $pid;
           $fcount->facility_name = $request->facility_name[$i];
           $fcount->distance = $request->distance[$i];
           $fcount->save();
       } // end for
    }

     $notification = array(
        'message' => 'Property Facility Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}
public function AgentDeleteProperty($id){

    $property = Property::findOrFail($id);
    unlink($property->property_thumbnail);

    Property::findOrFail($id)->delete();

    $image = MultiImage::where('property_id',$id)->get();

    foreach($image as $img){
        unlink($img->photo_name);
        MultiImage::where('property_id',$id)->delete();
    }

    $facilitiesData = Facility::where('property_id',$id)->get();
    foreach($facilitiesData as $item){
        $item->facility_name;
        Facility::where('property_id',$id)->delete();
    }


     $notification = array(
        'message' => 'Property Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}
}

