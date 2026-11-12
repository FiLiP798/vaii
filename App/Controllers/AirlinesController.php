<?php

namespace App\Controllers;

use App\Models\Airline;
use App\Models\Flight;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class AirlinesController extends BaseController
{
    public function authorize(Request $request, string $action): bool { return true; }

    public function index(Request $request): Response
    {
        return $this->html($this->pageData());
    }

    private function pageData(): array
    {
        $airlines = Airline::getAll(orderBy: 'name ASC');
        $uses = [];
        foreach (Flight::getAll() as $flight) { $uses[(string)$flight->airline_id] = ($uses[(string)$flight->airline_id] ?? 0) + 1; }
        arsort($uses);
        $topAirline = $uses ? Airline::getOne(array_key_first($uses)) : null;
        return [
            'airlines' => $airlines,
            'uses' => $uses,
            'topAirline' => $topAirline,
            'topUses' => $uses ? reset($uses) : 0,
            'flightCount' => Flight::getCount(),
        ];
    }

    public function create(Request $request): Response
    {
        if ($request->isPost()) {
            $airline = new Airline();
            $airline->setFromRequest($request);
            $this->normalize($airline);
            try {
                $airline->save();
            } catch (\Exception $exception) {
                if (!$this->isDuplicate($exception)) { throw $exception; }
                return $this->html($this->pageData() + [
                    'airlineForm' => $airline,
                    'error' => 'Spoločnosť s týmto názvom alebo kódom IATA či ICAO už v katalógu existuje.',
                ]);
            }
        }
        return $this->redirect($this->url('airlines.index'))->setStatusCode(303);
    }

    public function edit(Request $request): Response
    {
        $airline = Airline::getOne($request->get('id'));
        return $airline ? $this->html(['airline' => $airline], 'form') : $this->redirect($this->url('airlines.index'))->setStatusCode(303);
    }

    public function update(Request $request): Response
    {
        if ($request->isPost()) {
            $airline = Airline::getOne($request->post('id'));
            if ($airline) {
                $airline->setFromRequest($request);
                $this->normalize($airline);
                try {
                    $airline->save();
                } catch (\Exception $exception) {
                    if (!$this->isDuplicate($exception)) { throw $exception; }
                    return $this->html([
                        'airline' => $airline,
                        'error' => 'Spoločnosť s týmto názvom alebo kódom IATA či ICAO už v katalógu existuje.',
                    ], 'form');
                }
            }
        }
        return $this->redirect($this->url('airlines.index'))->setStatusCode(303);
    }

    public function delete(Request $request): Response
    {
        if ($request->isPost()) { $airline = Airline::getOne($request->post('id')); if ($airline && Flight::getCount('airline_id = ?', [$airline->id]) === 0) { $airline->delete(); } }
        return $this->redirect($this->url('airlines.index'))->setStatusCode(303);
    }

    private function normalize(Airline $airline): void
    {
        $airline->name = trim($airline->name);
        $airline->country = trim($airline->country);
        if ($airline->iata_code === '') { $airline->iata_code = null; } else { $airline->iata_code = strtoupper(trim($airline->iata_code)); }
        if ($airline->icao_code === '') { $airline->icao_code = null; } else { $airline->icao_code = strtoupper(trim($airline->icao_code)); }
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
