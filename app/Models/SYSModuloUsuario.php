<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SYSModuloUsuario extends Model
{
    use HasFactory;
    protected $table = 'sis_modulo_usuarios';
    
    protected $fillable = ['sis_modulo_id', 'usuario_id', 'status_alta'];
}