<?php
namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Card;
use App\Models\Room;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function startGame($roomId)
    {
        $room = Room::findOrFail($roomId);
        $players = Player::where('room_id', $roomId)->get();

        if ($players->count() < 2) {
            return response()->json(['message' => 'يجب أن يكون هناك على الأقل لاعبان'], 400);
        }

        $gameResult = [];

        foreach ($players as $player) {
            $cards = Card::inRandomOrder()->limit(11)->get();
            $gameResult[] = [
                'player' => $player->name,
                'cards' => $cards
            ];
        }

        return response()->json($gameResult);
    }
}
