<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::all();
    }

    public function show($id)
    {
        $guest = Guest::findOrFail($id);

        return response()->json([
            'id' => $guest->id,
            'name' => $guest->name,
            'is_present' => $guest->is_present,
        ]);
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->update($request->all());
        return $guest;
    }
}

