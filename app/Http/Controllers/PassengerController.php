<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(Request $request)
    {
        $query = Passenger::query();

        
        if ($request->has('filter')) {
            
        }

       
        if ($request->has('sort')) {
            
        }

        return $query->paginate(10); 
    }

    public function show($id)
    {
        return Passenger::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Passenger::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->update($request->all());

        return $passenger;
    }

    public function destroy($id)
    {
        Passenger::destroy($id);

        return response()->json(['message' => 'Passenger deleted']);
    }
}

