<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ComplaintForm;
use Carbon\Carbon;


class IndexController extends Controller
{
    public function PropertyDetails($id, $slug) {
        // Retrieve the property by ID
        $property = Property::findOrFail($id);

        // Get the comma-separated amenities_id string from the property
        $amenities = $property->amenities_id;

        // Split the amenities_id string into an array of IDs
        $amenity_ids = explode(',', $amenities);

        // Fetch the names of the amenities based on the IDs
        $property_amen = Amenities::whereIn('id', $amenity_ids)->pluck('amenities_name')->toArray();

        // Fetch the images associated with the property
        $multiImage = MultiImage::where('property_id', $id)->get();
        $facility = Facility::where('property_id',$id)->get();

        // Pass the data to the view
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amen','facility'));
    }

    public function AgentDetails($id){

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id',$id)->get();

        return view('frontend.agent.agent_details',compact('agent','property'));

    }// End Method


    public function ListingProperty(){

        $property = Property::where('status','1')->get();

        return view('frontend.property.rent_property',compact('property'));

    }

    public function ComplaintForm(Request $request){


        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {

        ComplaintForm::insert([

            'user_id' => Auth::user()->id,
            'agent_id' => $aid,
            'property_id' => $pid,
            'complaint_name' => $request->complaint_name,
            'complaint_email' => $request->complaint_email,
            'complaint' => $request->complaint,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Complaint Form Submitted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



        }else{

            $notification = array(
            'message' => 'Please login to submit a complaint',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
        }
    }

    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->filled('property_status')) {
            $query->where('property_status', $request->property_status);
        }

        if ($request->filled('ptype_id')) {
            $query->where('ptype_id', $request->ptype_id);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '<=', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '<=', $request->bathrooms);
        }

        $properties = $query->get();

        return view('frontend.property.property_search', compact('properties'));
    }

}
