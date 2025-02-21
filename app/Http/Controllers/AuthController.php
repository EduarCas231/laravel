<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'correo_u' => 'required|email',
            'contraseña_u' => 'required',
        ]);
    
        $usuario = Usuarios::where('correo_u', $request->correo_u)->first();
    
        if ($usuario && Hash::check($request->contraseña_u, $usuario->contraseña_u)) {
            Auth::login($usuario);
            
           
            return redirect()->intended(route('productos'));
        }
    
        return back()->withErrors(['error' => 'Credenciales incorrectas']);
    }
    


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
