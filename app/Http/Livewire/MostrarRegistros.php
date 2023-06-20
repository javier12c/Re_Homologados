<?php

namespace App\Http\Livewire;

use App\Models\registro;
use Livewire\Component;

class MostrarRegistros extends Component
{
    public function render()
    {
        $registros = Registro::where('reg_fkusuario', auth()->user()->id)->paginate(10);
        return view('livewire.mostrar-registros', [
            'registros' => $registros,
        ]);
    }
}
