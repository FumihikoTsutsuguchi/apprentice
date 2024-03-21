<?php /*

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

         // 応答データの作成
        $responseData = [
            'user' => [
                'email' => $user->email,
                'token' => $user->token,
                'username' => $user->username,
                'bio' => $user->bio,
                'image' => $user->image,
            ]
        ];

        return response()->json($responseData, 201); // ステータスコード201: Createdを返す
    }
}
