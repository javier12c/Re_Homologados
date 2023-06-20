<?php

namespace App\Http\Livewire;

use App\Models\Cat_expediente;
use Livewire\Component;
use App\Models\Cat_unidadependencia;

class ModalExpediente extends Component
{
    public $nombreexpediente;
    public $dependenciass;


    protected $rules = [
        'nombreexpediente' => 'required',
        'dependenciass' => 'required'
    ];
    public function crearExpediente()
    {
        $datos = $this->validate();
        Cat_expediente::create([
            'exp_nombre' => $datos['nombreexpediente'],
            'exp_fkdepedencia' => $datos['dependenciass'],

        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'La vacante se publico correctamente');

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
