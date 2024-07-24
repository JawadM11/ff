<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Flight::class)
            ->allowedFilters([
                'flight_number', 
                'destination',
                AllowedFilter::exact('status'), 
            ])
            ->allowedSorts([
                'flight_number', 
                'created_at', 
            ]);

        return response()->json(['success' => true, 'data' => $query->paginate(10)]);
    }

    public function show(Flight $flight)
    {
        return response()->json(['success' => true, 'data' => $flight->load('passengers')]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'flight_number' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $flight = Flight::create($request->all());

        return response()->json(['success' => true, 'data' => $flight], 201);
    }

    public function update(Request $request, Flight $flight)
    {
        $validator = Validator::make($request->all(), [
            'flight_number' => 'sometimes|required|string|max:255',
            'destination' => 'sometimes|required|string|max:255',
            'departure_time' => 'sometimes|required|date',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $flight->update($request->all());

        return response()->json(['success' => true, 'data' => $flight]);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return response()->json(['success' => true, 'message' => 'Flight deleted']);
    }
}
