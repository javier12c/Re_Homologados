<?php

namespace App\Http\Controllers;

use App\Models\Cat_unidadependencia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    //

    public function index(User $user, Cat_unidadependencia $cat_unidadependencia)
    {
        return view('usuario.index', [
            'user' => $user,
            'cat_unidadependencia' => $cat_unidadependencia,
        ]);
    }
    public function show(User $user)
    {

        return view('usuario.show', [
            'user' => $user
        ]);
    }
    public function create()
    {
        $cat_unidadepedencias = Cat_unidadependencia::all();

        return view('usuario.create', [
            'cat_unidadepedencias' => $cat_unidadepedencias,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'sexo' => 'required',
            'rol' => 'required',
            'dependencia' => 'required',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'sexo' => $request->sexo,
            'rol' => $request->rol,
            'fkdepedencia' => $request->dependencia,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        //Creando mensaje
        session()->flash('mensaje', 'Se creo el usuario correctamente');

        //Redireccionando a la misma vista
        return redirect()->back();
    }
    public function shows()
    {
        return view('usuario.shows');
    }
}
