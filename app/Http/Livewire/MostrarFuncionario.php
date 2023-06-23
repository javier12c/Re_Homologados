<?php

namespace App\Http\Livewire;

use App\Models\Servidorespublico;
use Livewire\Component;

class MostrarFuncionario extends Component
{
    protected $listeners = ['EliminarFuncionario'];
    public function EliminarFuncionario(Servidorespublico $funcionario)
    {
        $funcionario->delete();
    }

    public function render()
    {
        $funcionarios = Servidorespublico::paginate(10);

        return view('livewire.mostrar-funcionario', [
            'funcionarios' => $funcionarios,
        ]);
    }
}
