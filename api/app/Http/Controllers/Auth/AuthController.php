<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequst;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return response()->json([
            'user' => $user,
            'access_token' => $user->createToken('app')->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {
            $user = Auth::user();

            return response()->success([
                'user' => Auth::user(),
                'access_token' => $user->createToken('app')->plainTextToken
            ]);
        }

        return response()->error('Teléfono o contraseña incorrectos', 404);
    }
}
