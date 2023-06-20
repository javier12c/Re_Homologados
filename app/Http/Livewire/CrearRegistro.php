<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cat_expediente;
use App\Models\Cat_tdocumento;
use App\Models\Servidorespublico;
use App\Models\Cat_unidadependencia;
use App\Models\registro;

class CrearRegistro extends Component
{
    // Declaracion de variables wire:model
    public $reg_fecha_documento;
    public $tipo_documento;
    public $reg_ndocumento;
    public $dependencia;
    public $asunto;
    public $servidorespublicoss = null;
    public $cargo = null;
    public $dirigido = null;
    public $cargo2 = null;
    public $anexo;
    public $seguimiento_realizado;
    public $resguardo;
    public $hipervinculo;
    public $expediente;
    public $serie;
    public $ubicacion;
    public $observaciones;
    public $status = 1;

    //Funcionario

    // Reglas de validacion
    protected $rules = [
        'reg_fecha_documento' => 'required',
        'tipo_documento' => 'required',
        'reg_ndocumento' => 'required|string',
        'dependencia' => 'required',
        'asunto' => 'required|string',
        'servidorespublicoss' => 'required',
        'dirigido' => 'required',
        'anexo' => 'required',
        'seguimiento_realizado' => 'required',
        'resguardo' => 'required',
        'hipervinculo' => 'nullable',
        'expediente' => 'required',
        'serie' => 'required',
        'ubicacion' => 'required',
        'observaciones' => 'required',
        'status' => 'nullable',

    ];
    // Metodo para guardars
    public function crearRegistro()
    {
        $datos = $this->validate();
        registro::create([
            'reg_ndocumento' => $datos['reg_ndocumento'],
            'reg_asunto' => $datos['asunto'],
            'reg_anexos' => $datos['anexo'],
            'reg_seguimiento' => $datos['seguimiento_realizado'],
            'reg_resguardo' => $datos['resguardo'],
            'reg_hiper' => $datos['hipervinculo'],
            'reg_fkexpediente' => $datos['expediente'],
            'reg_series' => $datos['serie'],
            'reg_ubicacion' => $datos['ubicacion'],
            'reg_observaciones' => $datos['observaciones'],
            'reg_fktdocumento' => $datos['tipo_documento'],
            'reg_fkasignado' => $datos['servidorespublicoss'],
            'reg_fkdirigido' => $datos['dirigido'],
            'reg_fecha_documento' => $datos['reg_fecha_documento'],
            'reg_fkdepedencia' => $datos['dependencia'],
            'reg_fkusuario' => auth()->user()->id,
            'reg_status' =>  $datos['status'],
        ]);
        //Crear un mensaje
        session()->flash('mensaje', 'Se creo el registro correctamente');

        // Redireccionar el usuario
        return redirect()->route('registro.show');
    }

    public function render()
    {
        $cat_tdocumentos = Cat_tdocumento::all();
        $cat_unidadepedencias = Cat_unidadependencia::all();
        $servidorespublicos = Servidorespublico::orderBy("emp_nombre", "asc")->get();
        $expedientes = Cat_expediente::all();

        return view(
            'livewire.crear-registro',
            [
                'cat_tdocumentos' => $cat_tdocumentos,
                'cat_unidadepedencias' => $cat_unidadepedencias,
                'servidorespublicos' => $servidorespublicos,
                'expedientes' => $expedientes,
            ]
        );
    }
    public function updatedservidorespublicoss($id)
    {
        $this->cargo = Servidorespublico::find($id);
    }
    public function updateddirigido($id)
    {
        $this->cargo2 = Servidorespublico::find($id);
    }
}
