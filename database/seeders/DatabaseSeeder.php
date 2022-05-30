<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BirdSeeder::class,
            ColorSeeder::class,
            HabitatSeeder::class,
        ]);
        
        $birds = \App\Models\Bird::all();
        
        foreach ($birds as $bird) {
            if (isset($bird->color)) {
                $colorIds = explode('/', $bird->color);
                
                foreach ($colorIds as $colorId) {
                    $bird->colors()->attach($colorId);
                }
            }
            
            if (isset($bird->habitat)) {
                $habitatIds = explode('/', $bird->habitat);
                
                foreach ($habitatIds as $habitatId) {
                    $bird->habitats()->attach($habitatId);
                }
            }
        }
    }
}