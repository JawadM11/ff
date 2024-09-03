<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    public function index()
    {
        $users = User::all();
        return response ($users);}
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);

        return response ($user, 201);}

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response (['error' => 'User not found'], 404);
        }

        return response ($user);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response ($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response (['error' => 'User not found'], 404);
        }

        $user->delete();

        return response (['message' => 'User deleted successfully']);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response (['error' => 'User not found'], 404);
        }

        $user->update($request->only('name', 'email', 'password', 'address'));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response ($user);
    }
     /**
     * Destroy all sessions for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroySessions(Request $request)
    {
        $user = $request->user();
        $user->destroyAllSessions();

        return response(['message' => 'All sessions have been destroyed.']);
    }
}