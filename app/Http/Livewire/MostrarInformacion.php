<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class MostrarInformacion extends Component
{
    public $user;
    public $chart;

    public function render()
    {
        $chart_options = [
            'chart_title' => 'Registros por dia',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Registro',

            'relationship_name' => 'user', // represents function user() on Transaction model
            'group_by_field' => 'Created_at', // users.name

            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart = new LaravelChart($chart_options);
        return view('livewire.mostrar-informacion', [
            'chart' => $chart,
        ]);
    }
}
