<?php

namespace App\Http\Controllers;

use App\Models\Cat_unidadependencia;
use App\Models\User;
use Illuminate\Http\Request;

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
}
