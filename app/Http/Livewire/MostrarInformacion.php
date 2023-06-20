<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class MostrarInformacion extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.mostrar-informacion');
    }
}
