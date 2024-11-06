<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();

        return response()->json($tables->map(function ($table) {
            return [
                'id' => $table->id,
                'num' => $table->num,
                'description' => $table->description,
                'maxGuests' => $table->max_guests,
                'guestsDef' => $table->guestsDef,
                'guestsNow' => $table->guestsNow,
                'guests' => $table->guests->map(function ($guest) {
                    return route('guests.show', $guest->id);
                }),
            ];
        }));
    }
    
    
    public function show($id)
    {
        $table = Table::with('guests')->findOrFail($id);

        return response()->json([
            'id' => $table->id,
            'num' => $table->num,
            'description' => $table->description,
            'maxGuests' => $table->max_guests,
            'guestsDef' => $table->guestsDef,
            'guestsNow' => $table->guestsNow,
            'guests' => $table->guests->map(function ($guest) {
                return route('guests.show', $guest->id); 
            }),
        ]);
    }

    public function update(Request $request, $id)
{
    $table = Table::findOrFail($id);


    $validatedData = $request->validate([
        'num' => 'required|integer',
        'description' => 'nullable|string',
        'maxGuests' => 'nullable|integer',
    ]);

    $table->num = $validatedData['num'];
    $table->description = $validatedData['description'];
    $table->maxGuests = $validatedData['maxGuests']; 
    $table->save();

    return response()->json($table);
}

    public function guests($id)
    {
        $table = Table::with('guests')->findOrFail($id);
        return response()->json($table->guests);
    }

    public function stats()
    {
        $tables = Table::all();

        return response()->json($tables->map(function ($table) {
            return [
                'id' => $table->id,
                'num' => $table->num,
                'description' => $table->description,
                'maxGuests' => $table->max_guests,
                'guestsDef' => $table->guestsDef,
                'guestsNow' => $table->guestsNow,
                'guests' => $table->guests->map(function ($guest) {
                    return route('guests.show', $guest->id);
                }),
            ];
        }));
    }
    public function store(Request $request)
    {
        $request->validate([
            'num' => 'required|integer',
            'description' => 'nullable|string',
            'maxGuests' => 'required|integer',
        ]);

        $table = Table::create([
            'num' => $request->num,
            'description' => $request->description,
            'maxGuests' => $request->maxGuests,
        ]);

        return response()->json(['table' => $table], 201);
    }
    public function destroy($id)
{
    $table = Table::findOrFail($id);

    $table->delete();

    return response()->json(['message' => 'Стол успешно удален'], 200);
}

}
