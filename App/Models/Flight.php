<?php

namespace App\Models;

use Framework\Core\Model;

/** One entry in the mySkyLog flight diary. */
class Flight extends Model
{
    protected static ?string $tableName = 'flights';
    protected static ?string $primaryKey = 'id';
    protected static ?array $fillable = [
        'flight_number', 'departure_airport', 'arrival_airport', 'airline',
        'flight_date', 'distance_km', 'ticket_price', 'payment_method', 'notes',
    ];

    public $id = null;
    public $flight_number = '';
    public $departure_airport = '';
    public $arrival_airport = '';
    public $airline = '';
    public $flight_date = '';
    public $distance_km = null;
    public $ticket_price = null;
    public $payment_method = '';
    public $notes = '';
}
