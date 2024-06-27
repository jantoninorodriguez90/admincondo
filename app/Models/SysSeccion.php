<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SYSSeccion extends Model
{
    use HasFactory;
    
    protected $table = 'sis_secciones';
    
    protected $fillable = ['value', 'icon', 'sistema', 'order', 'status_alta'];
}