<?php

namespace App\Http\Livewire;

use App\Models\registro;
use Livewire\Component;

class MostrarRegistros extends Component
{
    public $expediente;
    public $termino;
    public $dependencia;
    protected $listeners = ['terminosBusqueda' => 'buscar'];
    public function buscar($termino, $expediente, $dependencia)
    {
        $this->termino = $termino;
        $this->dependencia = $dependencia;
        $this->expediente = $expediente;
    }
    public function render()
    {
        $registros = registro::when($this->termino, function ($query) {
            $query->where('reg_asunto', 'LIKE', "%" . $this->termino . "%");
        })
            ->paginate();
        $registros = Registro::where('reg_fkusuario', auth()->user()->id)->when($this->termino, function ($query) {
            $query->where('reg_asunto', 'LIKE', "%" . $this->termino . "%");
        })->when($this->termino, function ($query) {
            $query->orWhere('reg_ndocumento', 'LIKE', "%" . $this->termino . "%");
        })->when($this->dependencia, function ($query) {
            $query->where('reg_fkdepedencia', $this->dependencia);
        })->when($this->expediente, function ($query) {
            $query->where('reg_fkexpediente', $this->expediente);
        })
            ->paginate();
        return view('livewire.mostrar-registros', [
            'registros' => $registros,
        ]);
    }
}