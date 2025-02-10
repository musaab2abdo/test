<?php
namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function addPlayer(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Player::create(['name' => $request->name]);

        return response()->json(['message' => 'تمت إضافة اللاعب بنجاح']);
    }
}
