<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use Notifiable;

    protected $fillable = [
        'locationName',
        'address',
        'city',
        'state',
        'country',
        'currency',
        'postalCode',
        'GPdatabase',
        'VAT',
        'VATRate'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function materialLocations()
    {
        return $this->belongsTo(MaterialLocation::class);
    }

}
