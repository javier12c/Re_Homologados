<?php

namespace App\Http\Livewire;

use App\Models\Cat_expediente;
use Livewire\Component;
use App\Models\Cat_unidadependencia;

class ModalExpediente extends Component
{
    public $nombreexpediente;
    public $dependenciass;
    protected $listeners = ['MostrarPagina'];


    protected $rules = [
        'nombreexpediente' => 'required',
        'dependenciass' => 'required'
    ];
    public function MostrarPagina()
    {
        return view('registro.index');
    }
    public function crearExpediente()
    {
        $datos = $this->validate();
        Cat_expediente::create([
            'exp_nombre' => $datos['nombreexpediente'],
            'exp_fkdepedencia' => $datos['dependenciass'],

        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'El expediente se guardo');

        return redirect()->route('registro.index');
    }
    public function render()
    {

        $cat_unidadepedencias = Cat_unidadependencia::all();
        return view(
            'livewire.modal-expediente',
            [
                'cat_unidadepedencias' => $cat_unidadepedencias,
            ]
        );
    }
}
