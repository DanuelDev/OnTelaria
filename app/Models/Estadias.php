<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadias extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'reserva_id', 'quarto_id', 'data_checkin', 'data_checkout',
         'status', 'valor_estadia', 'observacoes'
    ];

    public function quarto()
    {
        return $this->belongsTo(Quartos::class, 'quarto_id');
    }

    public function reserva()
    {
        return $this->belongsTo(Reservas::class, 'reserva_id');
    }
}
