<?php /*

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Auth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            $user = Auth::user();
            // レスポンスを返す
            return response()->json([
                'user' => [
                    'email' => $user->email,
                    'token' => $token,
                    'username' => $user->username,
                    'bio' => $user->bio,
                    'image' => $user->image,
                ],
            ]);
        } else {
            return response()->json(['error' => '認証に失敗しました。'], 401);
        }
    }

}

