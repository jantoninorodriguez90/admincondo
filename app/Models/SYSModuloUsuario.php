<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SYSModuloUsuario extends Model
{
    use HasFactory;
    protected $table = 'sis_modulo_usuarios';
    
    protected $fillable = ['sis_modulo_id', 'usuario_id', 'status_alta'];

    public static function obtenerModulosConSecciones($usuarioId)
    {
        return DB::table('sis_modulo_usuarios as smu')
            ->join('sis_modulos as sm', 'sm.id', '=', 'smu.sis_modulo_id')
            ->join('sis_secciones as ss', 'ss.id', '=', 'sm.sis_seccion_id')
            ->where('smu.usuario_id', $usuarioId)
            ->select(
                'ss.id as id_menu',
                'ss.value as menu',
                'ss.icon as menu_icon',
                'sm.value as modulo',
                'sm.icon as modulo_icon',
                'sm.ruta as modulo_ruta'
            )
            ->get();
    }

    public function modulo() 
    {
        return $this->belongsTo(SYSModulo::class, 'sis_modulo_id', 'id');      
    }

    public function user() 
    {
        return $this->belongsTo(USer::class, 'usuario_id', 'id');      
    }
}