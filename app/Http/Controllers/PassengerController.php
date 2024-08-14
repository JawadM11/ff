<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Intervention\Image\Facades\Image; 

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

        return response(['success' => true, 'data' => $query->paginate(10)]);
    }

    public function show(Passenger $passenger)
    {
        return response(['success' => true, 'data' => $passenger]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $passenger = Passenger::create($request->except('image'));

       
        if ($request->hasFile('image')) {
            $this->uploadImage($request, $passenger);
        }

        return response(['success' => true, 'data' => $passenger], 201);
    }

    public function update(Request $request, Passenger $passenger)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:passengers,email,'.$passenger->id,
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $passenger->update($request->except('image'));

       
        if ($request->hasFile('image')) {
            $this->uploadImage($request, $passenger);
        }

        return response(['success' => true, 'data' => $passenger]);
    }

    public function destroy(Passenger $passenger)
{ 
    if ($passenger->image) {
    Storage::disk('public')->delete($passenger->image);
    Storage::disk('public')->delete('thumbnails/' . basename($passenger->image));
}

$passenger->delete();

return response(['success' => true, 'message' => 'Passenger deleted']);
}

private function uploadImage(Request $request, Passenger $passenger)
{

$image = $request->file('image');
$imagePath = $image->store('images/passengers', 'public');


$thumbnailPath = 'thumbnails/' . $image->hashName();
$thumbnail = Image::make($image)->resize(150, 150);
Storage::disk('public')->put($thumbnailPath, (string) $thumbnail->encode());


$passenger->image = $imagePath;
$passenger->save();}
        
    
}
