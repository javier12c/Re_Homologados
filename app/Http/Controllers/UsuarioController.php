<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Charts\Charts;
use App\Charts\Mostrar;
use App\Models\Registro;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\Cat_unidadependencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;

class UsuarioController extends Controller
{
    //

    public function index(User $user, Cat_unidadependencia $cat_unidadependencia)
    {
        $user = User::find(auth()->user()->id); // Reemplaza '1' con el ID del usuario que deseas mostrar

        $registros = $user->registros()
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total_registros')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $fechas = $registros->pluck('fecha')->toArray();
        $cantidades = $registros->pluck('total_registros')->toArray();

        return view('usuario.show', [
            'user' => $user,
            'fechas' => $fechas,
            'cantidades' => $cantidades
        ]);
    }
    public function show(User $user)
    {
        // $chart_options = [
        //     'chart_title' => 'Registros por semana',
        //     'chart_type' => 'bar',
        //     'report_type' => 'group_by_relationship',
        //     'model' => 'App\Models\User',
        //     'relationship_name' => 'registro', // represents function user() on Transaction model
        //     'group_by_field' => 'created_at', // users.nam
        //     'filter_field' => 'created_at',
        //     'filter_days' => 10, // show only transactions for last 30 days
        //     'filter_period' => 'week', // show only transactions for this week
        // ];
        // $chart = new LaravelChart($chart_options);

        // Obtén los datos de la base de datos
        $user = User::find(auth()->user()->id); // Reemplaza '1' con el ID del usuario que deseas mostrar

        $registros = $user->registros()
            ->selectRaw('DATE(created_at) as fecha, COUNT(*) as total_registros')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $fechas = $registros->pluck('fecha')->toArray();
        $cantidades = $registros->pluck('total_registros')->toArray();

        return view('usuario.show', [
            'user' => $user,
            'fechas' => $fechas,
            'cantidades' => $cantidades
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
