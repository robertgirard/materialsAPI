<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Material extends Model
{

    use Notifiable;

    protected $fillable = [
        'materialName',
        'description',
        'manufacturer',
//        'partNo',
        'typeID',
        'familyId',
        'classId',
        'specGrav',
        'units',
        'unitCost',
        'vatTax',
        'vatTaxRate',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function materialLocations() 
    {
        return $this->hasMany(MaterialLocation::class);
    }

    public function materialComponents()
    {
        return $this->hasMany(MaterialComponent::class);
    }

    public function getCostAttribute()
    {
        return DB::table('material_locations')->select('location_id', DB::raw('(unitCost + freightCost) as total_cost'))
            ->where('material_id','=', $this->id)
            ->get();
/*        
        return MaterialLocation::select('location_id', DB::raw('(unitCost + freightCost) as total_cost'))
            ->where('material_id','=', $this->id)
            ->get();
*/            
    }

    public function getRemovedComponentsAttribute()
    {
        return [];
    }

    public function getRemovedLocationsAttribute()
    {
        return [];
    }

    protected $appends = ['cost', 'removed_components', 'removed_locations'];

  

}
