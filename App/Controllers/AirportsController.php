<?php

namespace App\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class AirportsController extends BaseController
{
    public function authorize(Request $request, string $action): bool { return true; }

    public function index(Request $request): Response
    {
        return $this->html($this->pageData());
    }

    private function pageData(): array
    {
        $airports = Airport::getAll(orderBy: 'city ASC');
        $visits = [];
        foreach (Flight::getAll() as $flight) {
            foreach ([$flight->departure_airport_id, $flight->arrival_airport_id] as $id) {
                $visits[(string)$id] = ($visits[(string)$id] ?? 0) + 1;
            }
        }
        arsort($visits);
        $topAirport = null;
        if ($visits) {
            $topAirport = Airport::getOne(array_key_first($visits));
        }
        return [
            'airports' => $airports,
            'visits' => $visits,
            'topAirport' => $topAirport,
            'topVisits' => $visits ? reset($visits) : 0,
            'visitedCount' => count($visits),
            'flightCount' => Flight::getCount(),
        ];
    }

    public function create(Request $request): Response
    {
        if ($request->isPost()) {
            $airport = new Airport();
            $airport->setFromRequest($request);
            $this->normalize($airport);
            try {
                $airport->save();
            } catch (\Exception $exception) {
                if (!$this->isDuplicate($exception)) { throw $exception; }
                return $this->html($this->pageData() + [
                    'airportForm' => $airport,
                    'error' => 'Letisko s týmto kódom IATA alebo ICAO už v katalógu existuje.',
                ]);
            }
        }
        return $this->redirect($this->url('airports.index'))->setStatusCode(303);
    }

    public function edit(Request $request): Response
    {
        $airport = Airport::getOne($request->get('id'));
        return $airport ? $this->html(['airport' => $airport], 'form') : $this->redirect($this->url('airports.index'))->setStatusCode(303);
    }

    public function update(Request $request): Response
    {
        if ($request->isPost()) {
            $airport = Airport::getOne($request->post('id'));
            if ($airport) {
                $airport->setFromRequest($request);
                $this->normalize($airport);
                try {
                    $airport->save();
                } catch (\Exception $exception) {
                    if (!$this->isDuplicate($exception)) { throw $exception; }
                    return $this->html([
                        'airport' => $airport,
                        'error' => 'Letisko s týmto kódom IATA alebo ICAO už v katalógu existuje.',
                    ], 'form');
                }
            }
        }
        return $this->redirect($this->url('airports.index'))->setStatusCode(303);
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) {
            $airport = Airport::getOne($request->post('id'));
            if ($airport && Flight::getCount('departure_airport_id = ? OR arrival_airport_id = ?', [$airport->id, $airport->id]) === 0) { $airport->delete(); }
        }
        return $this->redirect($this->url('airports.index'))->setStatusCode(303);
    }

    private function normalize(Airport $airport): void
    {
        $airport->name = trim($airport->name);
        $airport->city = trim($airport->city);
        $airport->country = trim($airport->country);
        if ($airport->icao_code === '') { $airport->icao_code = null; }
        $airport->iata_code = strtoupper(trim($airport->iata_code));
        if ($airport->icao_code !== null) { $airport->icao_code = strtoupper(trim($airport->icao_code)); }
    }

    private function isDuplicate(\Throwable $exception): bool
    {
        for ($cause = $exception; $cause !== null; $cause = $cause->getPrevious()) {
            if ($cause instanceof \PDOException && isset($cause->errorInfo[1]) && (int)$cause->errorInfo[1] === 1062) {
                return true;
            }
        }
        return false;
    }
}
