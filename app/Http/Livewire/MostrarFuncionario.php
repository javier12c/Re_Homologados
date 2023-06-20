<?php

namespace App\Http\Livewire;

use App\Models\Servidorespublico;
use Livewire\Component;

class MostrarFuncionario extends Component
{
    public function render()
    {
        $funcionarios = Servidorespublico::paginate(10);

        return view('livewire.mostrar-funcionario', [
            'funcionarios' => $funcionarios,
        ]);
    }
}
