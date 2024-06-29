<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SYSModulo extends Model
{
    use HasFactory;
    protected $table = 'sis_modulos';
    
    protected $fillable = ['sis_seccion_id', 'value', 'icon', 'ruta', 'order', 'status_alta'];
}