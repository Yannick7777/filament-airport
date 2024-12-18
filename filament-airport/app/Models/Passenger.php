<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Passenger extends Model
{
    use HasFactory;

    public $fillable = ['email'];

    public function flights(): BelongsToMany
    {
        return $this->belongsToMany(Flight::class, 'passenger_flight');
    }
}
