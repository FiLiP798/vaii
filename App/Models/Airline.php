<?php

namespace App\Models;

use Framework\Core\Model;

class Airline extends Model
{
    protected static ?string $tableName = 'airlines';
    protected static ?string $primaryKey = 'id';
    protected static ?array $fillable = ['iata_code', 'icao_code', 'name', 'country'];

    public $id = null;
    public $iata_code = '';
    public $icao_code = '';
    public $name = '';
    public $country = '';
}
