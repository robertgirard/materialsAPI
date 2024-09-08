<?php
use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Material::class, 10)->create();
//        factory(Material::class, 200)->create()->each(function ($material) {
//            $material->materialLocations()->save(factory(App\MaterialLocation::class)->make());
//        });

    }
}

