<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airline;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        $flights = Flight::getAll(orderBy: 'id DESC');
        $airports = Airport::getAll(orderBy: 'city ASC');
        $airlines = Airline::getAll(orderBy: 'name ASC');
        $distance = 0;
        $expenses = 0.0;
        $airportVisits = [];
        $airportMap = [];
        $airlineMap = [];
        foreach ($airports as $airport) {
            $airportMap[(string)$airport->id] = $airport;
        }
        foreach ($airlines as $airline) {
            $airlineMap[(string)$airline->id] = $airline;
        }
        foreach ($flights as $flight) {
            $distance += (int)($flight->distance_km ?? 0);
            $expenses += (float)($flight->ticket_price ?? 0);
            foreach ([$flight->departure_airport_id, $flight->arrival_airport_id] as $airportId) {
                $airportVisits[(string)$airportId] = ($airportVisits[(string)$airportId] ?? 0) + 1;
            }
        }
        arsort($airportVisits);
        $mostVisitedAirport = $airportVisits ? ($airportMap[(string)array_key_first($airportVisits)] ?? null) : null;
        $airlineFlights = [];
        foreach ($flights as $flight) {
            $airlineFlights[(string)$flight->airline_id] = ($airlineFlights[(string)$flight->airline_id] ?? 0) + 1;
        }
        arsort($airlineFlights);
        $mostUsedAirline = $airlineFlights ? ($airlineMap[(string)array_key_first($airlineFlights)] ?? null) : null;
        return $this->html([
            'flightCount' => count($flights),
            'totalDistance' => $distance,
            'airportCount' => count($airportVisits),
            'totalExpenses' => $expenses,
            'recentFlights' => array_slice($flights, 0, 5),
            'airportMap' => $airportMap,
            'airlineMap' => $airlineMap,
            'mostVisitedAirport' => $mostVisitedAirport,
            'mostVisitedCount' => $airportVisits ? reset($airportVisits) : 0,
            'mostUsedAirline' => $mostUsedAirline,
            'mostUsedAirlineCount' => $airlineFlights ? reset($airlineFlights) : 0,
        ]);
    }


    /**
     * Displays the mySkyLog flight diary page.
     */
    public function flights(Request $request): Response
    {
        $airports = Airport::getAll(orderBy: 'city ASC');
        $airlines = Airline::getAll(orderBy: 'name ASC');
        $airportMap = [];
        $airlineMap = [];
        foreach ($airports as $airport) {
            $airportMap[(string)$airport->id] = $airport;
        }
        foreach ($airlines as $airline) {
            $airlineMap[(string)$airline->id] = $airline;
        }
        return $this->html([
            'flights' => Flight::getAll(orderBy: 'flight_date DESC, id DESC'),
            'airports' => $airports,
            'airlines' => $airlines,
            'airportMap' => $airportMap,
            'airlineMap' => $airlineMap,
        ]);
    }

    /** Save a new flight diary entry. */
    public function createFlight(Request $request): Response
    {
        if (!$request->isPost()) {
            return $this->redirect($this->url('home.flights') . '#formular-pridania')->setStatusCode(303);
        }
        $flight = new Flight();
        $flight->setFromRequest($request);
        $this->normalizeOptionalFields($flight);
        $flight->save();
        return $this->redirect($this->url('home.flights'))->setStatusCode(303);
    }

    /** Show the edit form for an existing entry. */
    public function editFlight(Request $request): Response
    {
        $flight = Flight::getOne($request->get('id'));
        if ($flight === null) {
            return $this->redirect($this->url('home.flights'))->setStatusCode(303);
        }
        return $this->html([
            'flight' => $flight,
            'airports' => Airport::getAll(orderBy: 'city ASC'),
            'airlines' => Airline::getAll(orderBy: 'name ASC'),
        ], 'flight_form');
    }

    /** Update an existing flight diary entry. */
    public function updateFlight(Request $request): Response
    {
        if ($request->isPost()) {
            $flight = Flight::getOne($request->post('id'));
            if ($flight !== null) {
                $flight->setFromRequest($request);
                $this->normalizeOptionalFields($flight);
                $flight->save();
            }
        }
        return $this->redirect($this->url('home.flights'))->setStatusCode(303);
    }

    /** Delete a selected entry. */
    public function deleteFlight(Request $request): Response
    {
        if ($request->isPost()) {
            $flight = Flight::getOne($request->post('id'));
            $flight?->delete();
        }
        return $this->redirect($this->url('home.flights'))->setStatusCode(303);
    }

    /** Convert empty optional form inputs to SQL NULL (numeric columns reject empty strings). */
    private function normalizeOptionalFields(Flight $flight): void
    {
        foreach (['distance_km', 'ticket_price'] as $field) {
            if ($flight->{$field} === '') {
                $flight->{$field} = null;
            }
        }
        if ($flight->payment_method === '') {
            $flight->payment_method = null;
        }
    }

}
