<?php

namespace Database\Seeders;

use App\Models\Bird;
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
            BehaviorSeeder::class,
            ShapeSeeder::class,
            HabitatSeeder::class,
            CharacteristicSeeder::class,
        ]);
        
        $birds = Bird::all();
        
        foreach ($birds as $bird) {
            if (isset($bird->color)) {
                $colorIds = explode('&', $bird->color);
                
                foreach ($colorIds as $colorId) {
                    $bird->colors()->attach($colorId);
                }
            }
            
            if (isset($bird->behavior)) {
                $behaviorIds = explode('&', $bird->behavior);
                
                foreach ($behaviorIds as $behaviorId) {
                    $bird->behaviors()->attach($behaviorId);
                }
            }
            
            if (isset($bird->shape)) {
                $shapeIds = explode('&', $bird->shape);
                
                foreach ($shapeIds as $shapeId) {
                    $bird->shapes()->attach($shapeId);
                }
            }
            
            if (isset($bird->habitat)) {
                $habitatIds = explode('&', $bird->habitat);
                
                foreach ($habitatIds as $habitatId) {
                    $bird->habitats()->attach($habitatId);
                }
            }
            
            if (isset($bird->characteristics)) {
                $characteristicIds = explode('&', $bird->characteristics);
                
                foreach ($characteristicIds as $characteristicId) {
                    $bird->characteristics()->attach($characteristicId);
                }
            }
        }
    }
}