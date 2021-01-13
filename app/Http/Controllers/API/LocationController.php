<?php

namespace App\Http\Controllers\API;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{

   
    public function __construct()
    {

        $this->middleware('auth:sanctum');   
 
    }

    public function index()
    {
        //
        $locations = Location::latest()->orderBy('locationName')->get();
        return $locations;
        //return response()->json(['locations' => $locations,], 200);
    }

    public function store(Request $request)    
    {

        $this->validateData($request);

/*        
        $this->validate($request, [
            'locationName' => 'required',
            'city'         => 'required',
            'country'      => 'required',
            'currency'     => 'required' 
        ]);
*/
        $location = Location::create([
            'locationName'  => request('locationName'),
            'address'       => request('address'),
            'city'          => request('city'),
            'state'         => request('state'),
            'country'       => request('country'),
            'currency'      => request('currency'),
            'postalCode'    => request('postalCode'),
            'GPdatabase'    => request('GPdatabase'),
            'VAT'           => request('VAT'),
            'VATRate'       => request('VATRate')
        ]);

        return response()->json([
            'location'  => $location,
            'message'   => 'Success'
        ], 200);

    }

    public function show($id)
    {
        $location = Location::where(['id' => $id])->first();
        return $location;
    }

    public function update(Request $request, Location $location)
    {

        $this->validateData($request->id);

        $location = Location::find($request->id);

        $location->locationName  = request('locationName');
        $location->address       = request('address');
        $location->city          = request('city');
        $location->state         = request('state');
        $location->country       = request('country');
        $location->currency      = request('currency');
        $location->postalCode    = request('postalCode');
        $location->GPdatabase    = request('GPdatabase');
        $location->VAT           = request('VAT');
        $location->VATRate       = request('VATRate');
        $location->save();

  
        return response()->json([
            'message' => 'Location updated successfully'
        ], 200);
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json([
            'message' => 'Location Deleted Successfully!'
        ]);
    }

    private function validateData($id)
    {
        return request()->validate([
            'locationName' => ['required', Rule::unique('locations','locationName')->ignore($id)],
            'city'         => 'required',
            'country'      => 'required',
            'currency'     => 'required'             
        ]);
    }
}

