<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Vulnerabilidad: sin validacion robusta y guardando password en texto plano.
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return redirect('/login')->with('status', 'Usuario registrado.');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Vulnerabilidad (SQLi): concatenacion directa de input en query SQL.
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $users = DB::select($sql);

        if (count($users) > 0) {
            $user = $users[0];

            // Vulnerabilidad (Broken Auth): token predecible y sin regenerar sesion.
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'auth_token' => 'lab-token-' . $user->id,
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Credenciales invalidas.');
    }

    public function logout(Request $request)
    {
        // Vulnerabilidad (Broken Auth): cierre de sesion incompleto.
        $request->session()->forget('user_name');

        return redirect('/login')->with('status', 'Sesion cerrada parcialmente.');
    }
}
