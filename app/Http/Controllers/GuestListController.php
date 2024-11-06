<?php

namespace App\Http\Controllers;

use App\Models\GuestList;
use App\Models\Table;
use Illuminate\Http\Request;

class GuestListController extends Controller
{
    public function index()
    {
        $guestLists = GuestList::with('guest')->get();

        return response()->json($guestLists->map(function ($guestList) {
            return [
                'id' => $guestList->id,
                'name' => $guestList->guest->name,
                'isPresent' => $guestList->is_present,
                'tables' => [
                    'id' => $guestList->table->id,
                    'num' => $guestList->table->num,
                    'description' => $guestList->table->description,
                    'maxGuests' => $guestList->table->maxGuests,
                    'guestsDef' => $guestList->table->guestsDef,
                    'guestsNow' => $guestList->table->guestsNow,
                    'guests' => $guestList->table->guests->map(function ($guest) {
                        return route('guests.show', ['id' => $guest->id]);
                    }),
                ],
            ];
        }));
    }

    public function show($id)
{
    $guestList = GuestList::with('table', 'guest')->findOrFail($id);

    return response()->json([
        'id' => $guestList->id,
        'name' => $guestList->guest->name,
        'isPresent' => $guestList->is_present,
        'tables' => $guestList->table ? [
            'id' => $guestList->table->id,
            'num' => $guestList->table->num,
            'description' => $guestList->table->description,
            'maxGuests' => $guestList->table->maxGuests,
            'guestsDef' => $guestList->table->guestsDef,
            'guestsNow' => $guestList->table->guestsNow,
            'guests' => $guestList->table->guests->map(function ($guest) {
                return route('guests.show', ['id' => $guest->id]);
            }),
        ] : null,
    ]);
}


public function update(Request $request, $id)
{
    $guestList = GuestList::findOrFail($id);


    if ($request->has('name') || $request->has('is_present')) {
        $guestList->guest()->update($request->only(['name', 'is_present']));
    }

    return response()->json([
        'id' => $guestList->id,
        'name' => $guestList->guest->name,
        'isPresent' => $guestList->guest->is_present,
        'tables' => route('tables.show', ['id' => $guestList->id_table]),
    ]);
}
public function destroy($id)
{
    $guestList = GuestList::findOrFail($id);
    $guestList->delete();

    return response()->json(['message' => 'Запись в списке гостей успешно удалена'], 200);
}


}


