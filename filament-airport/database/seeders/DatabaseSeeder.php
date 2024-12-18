<?php

namespace Database\Seeders;

use App\Models\Airplane;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'email'=>'admin@bfo.ch',
            'name'=>'admin@bfo.ch',
            'password'=>Hash::make('admin@bfo.ch'),
        ]);

        $plane747 = Airplane::create([
            'typ'=>'747',
        ]);

        $planeA380 = Airplane::create([
            'typ'=>'380',
        ]);

        $airportZrh = Airport::create([
            'short_name'=>'ZRH',
            'name'=>'Zürich',
        ]);

        $airportLax = Airport::create([
            'short_name'=>'LAX',
            'name'=>'Los Angeles',
        ]);

        $airportJfk = Airport::create([
            'short_name'=>'JFK',
            'name'=>'New York',
        ]);

        $airportLhr = Airport::create([
            'short_name'=>'LHR',
            'name'=>'London',
        ]);

        $flight1 = Flight::create([
            'number'=>'255686',
            'departure_date'=>now(),
            'arrival_date'=>now()->addHours(12),
            'airplane_id'=>$plane747->id,
            'start_airport_id'=>$airportZrh->id,
            'end_airport_id'=>$airportLax->id,
        ]);

        $flight2 = Flight::create([
            'number'=>'531386',
            'departure_date'=>now(),
            'arrival_date'=>now()->addHours(6),
            'airplane_id'=>$planeA380->id,
            'start_airport_id'=>$airportJfk->id,
            'end_airport_id'=>$airportLhr->id,
        ]);

        $passenger1 = Passenger::create(['email' => 'passener1@bfo.ch']);
        $passenger2 = Passenger::create(['email' => 'passener2@bfo.ch']);
        $passenger3 = Passenger::create(['email' => 'passener3@bfo.ch']);

        $flight1->passengers()->attach($passenger1->id);
        $flight2->passengers()->attach($passenger1->id);
        $flight2->passengers()->attach($passenger2->id);
        $flight2->passengers()->attach($passenger3->id);
    }
}
