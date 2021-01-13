<?php

namespace App;

use App\Models\Material;
use App\Models\Location;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class MaterialLocation extends Model
{
    use Notifiable;

    protected $fillable = [
        'material_id',
        'location_id',
        'GPItemNumber',
        'units',
        'unitCost',
        'freightCost',
        'totalCost',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];//


    public function material() 
    {
        return $this->belongsTo(Material::class);
    }




 

/*    
    public function component()
    {
        return $this->belongsTo(MaterialAssembly::class, 'material_id','component_id');
    }


    public function componentCost()
    {
        return $this->belongsTo(MaterialComponent::class, 'component_id', 'material_id');
    }

 

*/
    /*
    The accessor field
    */
    //protected $appends = ['total_cost'];

    /*
    Accessor for the total price
    */
    /*
    public function getTotalCostAttribute()
    {
        return $this->unitCost + $this->freightCost;
    }
    */
}
