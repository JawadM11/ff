<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

       
        if ($request->has('filter')) {
           
        }

        
        if ($request->has('sort')) {
            
        }

        return $query->paginate(10); 
    }

    public function show($id)
    {
        return Flight::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Flight::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->update($request->all());

        return $flight;
    }

    public function destroy($id)
    {
        Flight::destroy($id);

        return response()->json(['message' => 'Flight deleted']);
    }

    public function passengers($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        return $flight->passengers()->paginate(10); 
    }
}
