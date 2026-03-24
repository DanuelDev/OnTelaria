<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'hospede_id', 'data_inicio', 'data_fim',
        'status', 'valor_total', 'observacoes'
    ];

    public function hospede()
    {
        return $this->belongsTo(Hospede::class, 'hospede_id');
    }
}
