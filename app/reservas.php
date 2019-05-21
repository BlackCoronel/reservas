<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    protected $fillable = ['referencia','estado','nombre','email','sociedad','cargo','telefono','dia','hora','modelo','token'];

    protected $table = 'reservas';
}
