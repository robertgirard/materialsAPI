<?php

namespace App\Models;

//use App\Material;
use Illuminate\Notifications\Notifiable;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class MaterialComponent extends Model
{

    use Notifiable;

    protected $fillable = [
        'id',
        'material_id',
        'component_id',
        'quantity'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];//

    //
    //protected $with = ['cost'];
       
    /*
    public function material()
    {
        return $this->belongsTo('App\Material','material_id');
    }
*/

    public function component()
    {
        return $this->belongsTo('App\Material','component_id');
    }

          
    public function getspecGravAttribute()
    {
        $base = Material::find($this->component_id);
        
        return $base->specGrav;
   //r
        return Material::all()->where('id' === '$this.component_id')->specGrav;
    }
 
    public function getPartsByVolumeAttribute()
    {
        $base2 = Material::find($this->component_id);
        $sg = $base2->specGrav;

        $pbv = $this->quantity / $sg;

        return $pbv;

    }

    public function getCostAttribute()
    {
        return MaterialLocation::select('location_id', DB::raw('(unitCost + freightCost) as total_cost'))
            ->where('material_id','=', $this->component_id)
            ->get();

    }

//    protected $appends = ['spec_grav', 'parts_by_volume', 'cost'];
    protected $appends = ['specGrav', 'parts_by_volume', 'cost'];
//    protected $appends = ['parts_by_volume'];
}
