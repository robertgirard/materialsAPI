<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Auth;
use App\Models\Material;
use App\MaterialComponent;
use App\MaterialLocation;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
 
    public function __construct()
    {

//         $this->middleware('auth:api');
 
    }

/*

    public function materialLocations() 
    {
        return $this->hasMany('App\MaterialLocation');
    }

    public function materialAssemblies()
    {
        return $this->hasMany('App\MaterialAssemblies');
    }
  */  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$materials = Material::latest()->orderBy('created_at', 'desc')->get();
        //$materials = Material::orderBy('materialName', 'asc')->get()->with('materialLocations', $materials->materialLocations);
        //$materials = Material::orderBy('materialName', 'asc')->get();
        //return response()->json(['materials' => $materials,], 200);
//        $material = Material::all('id', 'materialName','description', 'manufacturer', 'typeID', 'specGrav');
//        $materiallocations = $material->materialLocations;
//        return response()->json( $material );
//        $material = Material::all('id', 'materialName','description', 'manufacturer', 'typeID', 'specGrav');
//        $materials = Material::all();
        $materials = Material::orderBy('materialName', 'asc')->get();
//        $materiallocations = $material->materialLocations;
//        return Material::all('id', 'materialName','description', 'manufacturer', 'typeID', 'specGrav');
        //return Material::all();
        
        //return $material;

        return response()->json($materials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'materialName'   => 'required',
   //         'description'    => 'required',
  //          'partNo'         => 'required',
  //          'typeId'         => 'required',
  //          'specGrav'       => 'required|numeric|min:0|not_in:0',
  //          'units'          => 'required'
        ]);


       //$id = Auth::id(); 
        
        $material = Material::create([
            'materialName' => request('materialName'),
            'description'  => request('description'),
            'manufacturer' => request('manufacturer'),
            'typeID'       => request('typeID'),
            'specGrav'     => request('specGrav'),
        ]);

        $material->materialLocations()->createMany($request->material_locations);
        $material->materialComponents()->createMany($request->material_components);

             
        return response()->json([
            'material'    => $material,
            'message' => 'Success'
        ], 200);////
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::where(['id' => $id])->first();
        $materiallocations = $material->materialLocations;
        $materialComponents = $material->materialComponents;
        $cost = MaterialLocation::select('location_id', DB::raw('(unitCost + freightCost) as total_cost'))
            ->where('material_id','=', $id)
            ->get();

        return response()->json( $material );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $this->validate($request, [
            'materialName'   => 'required',
         ]);
         
        $material->materialName = request('materialName');
        $material->description  = request('description');
        $material->manufacturer = request('manufacturer');
        $material->typeID       = request('typeID');
        $material->specGrav     = request('specGrav');
        $material->save();

        MaterialComponent::whereIn('id', $request->removed_components)->delete();

        $components = [];
        foreach($request->material_components as $comps) {
            if ($comps['id'] === 0) {
                $item = new MaterialComponent($comps);
            } else {
                $item = MaterialComponent::find($comps['id']);
                $item->material_id  = $comps['material_id'];
                $item->component_id = $comps['component_id'];
                $item->quantity     = $comps['quantity'];
            }
            array_push($components, $item);
        }
        
        $material->materialComponents()->saveMany($components);

        MaterialLocation::whereIn('id', $request->removed_locations)->delete();

        $locations = [];
        foreach($request->material_locations as $locs){

            if ($locs['id'] === 0) {
                $item = new MaterialLocation($locs);
            } else {
                $item = MaterialLocation::find($locs['id']);
                $item->location_id  = $locs['location_id'];
                $item->material_id  = $locs['material_id'];
                $item->units        = $locs['units'];
                $item->unitCost     = $locs['unitCost'];
                $item->freightCost  = $locs['freightCost'];
                $item->GPItemNumber = $locs['GPItemNumber'];
            }
            array_push($locations, $item);
        }

        $material->materialLocations()->saveMany($locations);



 
        return response()->json([
            'message' => 'Material updated successfully!'
        ], 200);//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return response()->json([
            'message' => 'Material deleted successfully!'
        ], 200);
    }
}
