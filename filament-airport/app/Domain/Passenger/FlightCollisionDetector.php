<?php

namespace App\Domain\Passenger;

use App\Models\Passenger;

class FlightCollisionDetector
{
    public static function run(Passenger $passenger): string
    {
        // [..]
        // do the magic here
        // [..]
        return "Collision!";
    }
}
