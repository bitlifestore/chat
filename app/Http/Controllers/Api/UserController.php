<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PushToken;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('q');
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($users);
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function savePushToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'device_type' => 'sometimes|string|in:ios,android,web',
        ]);

        $pushToken = PushToken::updateOrCreate(
            ['user_id' => $request->user()->id, 'token' => $request->token],
            ['device_type' => $request->device_type]
        );

        return response()->json($pushToken);
    }
}
