<?php

namespace Database\Seeders;

use App\Models\Ville;
use App\Models\Gare;
use App\Models\Bus;
use App\Models\Programme;
use App\Models\Route;
use App\Models\Etape;
use App\Models\Segment;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    public function run()
    {
        $v1 = Ville::create(['name' => 'Casablanca']);
        $v2 = Ville::create(['name' => 'Marrakech']);
        $v3 = Ville::create(['name' => 'Rabat']);
        $v4 = Ville::create(['name' => 'Tangier']);

        $g1 = Gare::create(['name' => 'Casa Voyageurs', 'ville_id' => $v1->id, 'address' => 'Center Casablanca']);
        $g2 = Gare::create(['name' => 'Marrakech City Center', 'ville_id' => $v2->id, 'address' => 'Bab Doukkala Area']);
        $g3 = Gare::create(['name' => 'Rabat Agdal', 'ville_id' => $v3->id, 'address' => 'Agdal District']);
        $g4 = Gare::create(['name' => 'Tangier Ville', 'ville_id' => $v4->id, 'address' => 'Boulevard Mohamed V']);

        $bus1 = Bus::create([
            'model' => 'Mercedes Tourismo', 
            'capacity' => 50, 
            'plate_number' => 'A-123-B'
        ]);

        $route1 = Route::create(['name' => 'North-South Line']);

        $e1 = Etape::create([
            'route_id' => $route1->id,
            'gare_id' => $g2->id,
            'order' => 1,
            'passage_hour' => '08:00:00'
        ]);

        $e2 = Etape::create([
            'route_id' => $route1->id,
            'gare_id' => $g1->id,
            'order' => 2,
            'passage_hour' => '11:00:00'
        ]);

        $e3 = Etape::create([
            'route_id' => $route1->id,
            'gare_id' => $g3->id,
            'order' => 3,
            'passage_hour' => '12:30:00'
        ]);

        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        foreach ($days as $day) {
            $prog = Programme::create([
                'route_id' => $route1->id,
                'bus_id' => $bus1->id,
                'departure_day' => $day,
                'departure_time' => '08:00:00',
                'arrival_time' => '12:30:00'
            ]);

            Segment::create([
                'program_id' => $prog->id,
                'departure_id' => $e1->id,
                'arrival_id' => $e2->id,
                'tariff' => 95,
                'distance_in_km' => 240
            ]);

            Segment::create([
                'program_id' => $prog->id,
                'departure_id' => $e2->id,
                'arrival_id' => $e3->id,
                'tariff' => 50,
                'distance_in_km' => 90
            ]);

            Segment::create([
                'program_id' => $prog->id,
                'departure_id' => $e1->id,
                'arrival_id' => $e3->id,
                'tariff' => 140,
                'distance_in_km' => 330
            ]);
        }
    }
}