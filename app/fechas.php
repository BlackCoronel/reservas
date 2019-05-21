<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fechas extends Model
{
    protected $fillable = ['fecha','hora','referencia'];

    protected $table = 'fechas_reserva';
}
