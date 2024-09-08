<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'locationName' => 'Valtech Corporation',
            'address' => '2113 Sanatoga Station Road',
            'city' => 'Pottstown',
            'state' => 'PA',
            'country' => 'USA',
            'currency' => 'USD',
            'postalCode' => '19464',
            'GPdataBase' => 'VTC',
            'VAT' => 0,
            'VATRate' => 0
        ]);
        DB::table('locations')->insert([
            'locationName' => 'Valtech Shanghai Ltd.',
            'address' => 'No. 1288 Cang Gong Road',
            'city' => 'FengXian',
            'state' => 'Shanghai',
            'country' => 'CN',
            'currency' => 'RMB',
            'postalCode' => '201417',
            'GPdataBase' => 'VTSCH',
            'VAT' => 1,
            'VATRate' => 0.13
        ]);

    }
}

