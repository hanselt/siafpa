<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class GenericController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth')->only([
      'escritorio', 'escritorioProceso', 'perfil', 'usuario',
    ]);
  }

  public function front()
  {
    if (Auth::check()) {
      return redirect('escritorio');
    }
    return view('login');
  }

  public function iniciarSesion(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'estado' => true], $request->has('remember'))) {
      return redirect()->intended('escritorio');
    } else {
      return redirect('/')->withInput()->with('mensaje', 'Usuario y/o contraseña no válidos. O su usuario no está habilitado para acceder. Contacte al administrador.');
    }
  }

  public function escritorio()
  {
    return view('escritorio');
  }

  public function escritorioProceso($proceso)
  {
    $vista = $proceso . '.escritorio';
    if (view()->exists($vista)) {
      return view($vista);
    } else {
      return redirect('/');
    }
  }

  public function cerrarSesion(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/');
  }

  public function perfil()
  {
    return view('usuarios.perfil');
  }

  public function usuario()
  {
    $respuesta = [];
    try {
      $respuesta['usuario'] = Auth::user();
      $respuesta['resultado'] = true;
    } catch (\Exception $e) {
      $respuesta['resultado'] = false;
      $respuesta['mensaje'] = $e->getMessage();
    }
    return $respuesta;
  }
}
