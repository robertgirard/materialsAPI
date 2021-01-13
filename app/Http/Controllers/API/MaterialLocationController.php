<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Material;
use App\MaterialLocation;



class MaterialLocationController extends Controller
{

    public function __construct()
    {

//         $this->middleware('auth:api');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$materialLocations = MaterialLocation::orderBy('locationName', 'asc')->get();
        $materialLocations = MaterialLocation::all();
        //$materialLocations = App\MaterialLocation::all();
        //return response()->json(['materialLocations' => $materialLocations,], 200);
        //$materialLocations = MaterialLocation::orderBy('id', 'asc')->get();
        //$materialLocations = MaterialLocation::where(['material_id' => $id])->first();
        return response()->json(['materialLocations' => $materialLocations,], 200);
        //return $materialLocations;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $this->validate($request, [
                'material_id'   => 'required',
                'location_id'   => 'required',
       //         'description'    => 'required',
      //          'partNo'         => 'required',
      //          'typeId'         => 'required',
      //          'specGrav'       => 'required|numeric|min:0|not_in:0',
      //          'units'          => 'required'
            ]);
    
            //$id = Auth::id(); 
            
            $materialLocation = MaterialLocation::create([
                'material_id' => request('material_id'),
                'location_id'  => request('location_id'),
                'GPItemNumber' => request('GPItemNumber'),
                'units'         => request('units'),
                'unitCost'       => request('unitCost'),
                'freightCost'   => request('freightCost'),
            ]);
                
            return response()->json([
                'materialLocation'    => $materialLocation,
                'message' => 'Success'
            ], 200);////
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MaterialLocation  $materialLocation
     * @return \Illuminate\Http\Response
     */
    //public function show(MaterialLocation $materialLocation)
    public function show($id)
    {
        //$materialLocations = MaterialLocation::all()->where(['material_id' => $id])->first();
        $materialLocations = MaterialLocation::where(['material_id' => $id])->get();
        return $materialLocations;
        //return response()->json(['materialLocations' => $materialLocations,], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialLocation  $materialLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialLocation $materialLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialLocation  $materialLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialLocation $materialLocation)
    {
        $this->validate($request, [
//            'material_id'   => 'required',
            'location_id'   => 'required',  
        ]);
         
//        $materialLocation->material_id  = request('material_id');
        $materialLocation->location_id  = request('location_id');
//        $materialLocation->GPItemNumber = request('GPItemNumber');
        $materialLocation->units        = request('units');
        $materialLocation->unitCost     = request('unitCost');        
        $materialLocation->freightCost  = request('freightCost');
        $materialLocation->save();
                    
        return response()->json([
            'message' => 'Material Location updated successfully!'
        ], 200);//   //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialLocation  $materialLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialLocation $materialLocation)
    {
        $materialLocation->delete();
        return response()->json([
            'message' => 'Material Location deleted successfully!'
        ], 200);
    }
}
