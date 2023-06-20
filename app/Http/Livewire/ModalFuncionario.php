<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cat_unidadependencia;
use App\Models\Servidorespublico;

class ModalFuncionario extends Component
{

    public $nombre;
    public $dependencia;
    public $apellido;
    public $email;
    public $cargo;

    //Funcionario


    protected $rules = [
        'nombre' => 'required',
        'dependencia' => 'required',
        'apellido' => 'required',
        'email' => 'required|email|max:60',
        'cargo' => 'required',

    ];
    public function crearFuncionario()
    {
        $datos = $this->validate();

        Servidorespublico::create([
            'emp_nombre' => $datos['nombre'],
            'emp_apellido' => $datos['apellido'],
            'emp_correo' => $datos['email'],
            'emp_fkdepedencia' => $datos['dependencia'],
            'emp_puesto' => $datos['cargo'],
        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'El funcionario se publico correctamente');

        // Redireccionar el usuario
        return redirect()->route('registro.index');
    }
    public function render()
    {
        $cat_unidadepedencias = Cat_unidadependencia::all();

        return view('livewire.modal-funcionario', [
            'cat_unidadepedencias' => $cat_unidadepedencias,
        ]);
    }
}
