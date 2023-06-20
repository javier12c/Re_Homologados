<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $casts = ['reg_fecha_documento' => 'date'];


    protected $fillable = [
        'reg_ndocumento',
        'reg_asunto',
        'reg_anexos',
        'reg_seguimiento',
        'reg_resguardo',
        'reg_hiper',
        'reg_fkexpediente',
        'reg_series',
        'reg_ubicacion',
        'reg_observaciones',
        'reg_fktdocumento',
        'reg_fkasignado',
        'reg_fkdirigido',
        'reg_fecha_documento',
        'reg_fkdepedencia',
        'reg_fkusuario',
        'reg_status',
    ];
    public function dependencia()
    {
        return $this->belongsTo(Cat_unidadependencia::class, 'reg_fkdepedencia', 'dep_id');
    }
    public function servidor()
    {
        return $this->belongsTo(Servidorespublico::class, 'reg_fkasignado', 'id');
    }
    public function expediente()
    {
        return $this->belongsTo(Cat_expediente::class, 'reg_fkexpediente', 'exp_id');
    }
}
