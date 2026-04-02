<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'hospede_id', 'data_inicio', 'data_fim',
        'valor_total', 'status', 'observacoes',
    ];

    public function hospede()
    {
        return $this->belongsTo(Hospede::class, 'hospede_id');
    }

    public function estadias()
    {
        return $this->hasOne(Estadias::class, 'reserva_id');
    }
}