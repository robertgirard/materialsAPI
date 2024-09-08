<?php
use App\Models\Material;
use App\Models\MaterialLocation;
//use App\MaterialAssembly;
use App\Models\MaterialComponent;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MaterialLocationsSeeder extends Seeder
{
 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $materials = Material::all();

        $units = [
            'lbs',
            'KG',
            'Each'
        ];

        foreach ($materials as $material) {

            $j = 2;

            for ($i = 1; $i <= $j; $i++) {
                MaterialLocation::create(array(
                    'material_id' => $material->id,
                    'location_id' => $i,         
                    'GPItemNumber' => $faker->firstName,
                    'units' => mt_rand(1,3),
                    'unitCost' => abs( 1 - mt_rand() / mt_rand() ),
                    'freightCost' => abs( 1 - mt_rand() / mt_rand() ),
    //                'totalCost' => abs( 1 - mt_rand() / mt_getrandmax() )
                ));
                
            }

            $jj = rand(4,7);
            $totalquan = 0;
            for ($ii = 1; $ii <= $jj-1; $ii++) {
//                $addquan =  abs( 1 - mt_rand() / mt_rand() );
                $addquan =  abs(1 - mt_rand() / mt_getrandmax());
                MaterialComponent::create(array(                    
                    'material_id' => $material->id,
                    'component_id' => rand(1, $materials->count()),                       
                    'quantity' => $addquan,
                ));
                $totalquan = $totalquan + $addquan;
            }

            MaterialComponent::create(array(                    
                'material_id' => $material->id,
                'component_id' => rand(1, $materials->count()),                       
                'quantity' => 1 - $totalquan,
            ));


        }

//        factory(MaterialLocation::class, 200)->create();
    
    }

}
