<?php

namespace App\Models;

use Framework\Core\Model;

class Airport extends Model
{
    protected static ?string $tableName = 'airports';
    protected static ?string $primaryKey = 'id';
    protected static ?array $fillable = ['iata_code', 'icao_code', 'name', 'city', 'country'];

    public $id = null;
    public $iata_code = '';
    public $icao_code = '';
    public $name = '';
    public $city = '';
    public $country = '';
}
