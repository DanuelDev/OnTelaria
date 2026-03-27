<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadias extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'hospede_id', 'nome_completo', 'data_inicio', 'data_fim',
        'status', 'valor_total', 'observacoes'
    ];

    public function estadia()
    {
        return $this->belongsTo(Hospede::class, 'hospede_id');
    }
}
