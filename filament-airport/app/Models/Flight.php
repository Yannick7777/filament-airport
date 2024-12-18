<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Flight extends Model
{
    use HasFactory;

    public $fillable = [
        'airplane_id',
        'number',
        'start_airport_id',
        'end_airport_id',
        'departure_date',
        'arrival_date',
        'ready',
    ];

    public function airplane(): BelongsTo
    {
        return $this->belongsTo(Airplane::class);
    }

    public function start(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'start_airport_id');
    }

    public function end(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'end_airport_id');
    }

    public function passengers(): BelongsToMany
    {
        return $this->belongsToMany(Passenger::class, 'passenger_flight');
    }
}
