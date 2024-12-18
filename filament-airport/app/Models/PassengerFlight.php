<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PassengerFlight extends Model
{
    use HasFactory;

    public $table = 'passenger_flight';
    public $fillable = [
        'passenger_id',
        'flight_id',
    ];

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}
