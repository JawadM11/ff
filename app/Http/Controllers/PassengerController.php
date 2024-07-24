<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PassengerController extends Controller
{
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Passenger::class)
            ->allowedFilters([
                'first_name', 
                'last_name',  
                AllowedFilter::exact('status'), 
            ])
            ->allowedSorts([
                'first_name', 
                'created_at', 
            ]);

        return response()->json(['success' => true, 'data' => $query->paginate(10)]);
    }

    public function show(Passenger $passenger)
    {
        return response()->json(['success' => true, 'data' => $passenger]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $passenger = Passenger::create($request->all());

        return response()->json(['success' => true, 'data' => $passenger], 201);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:passengers,email,'.$passenger->id,
            
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $passenger->update($request->all());

        return response()->json(['success' => true, 'data' => $passenger]);
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();

        return response()->json(['success' => true, 'message' => 'Passenger deleted']);
    }
}
