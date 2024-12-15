<?php

use App\Models\SYSModuloUsuario;

function menu(){
    $model = new SYSModuloUsuario();
    $menu = $model->obtenerModulosConSecciones(auth()->id());
    $array_menu = [];

    if(!empty($menu)){
        foreach ($menu as $key => $value) {
            // Verifica si ya existe el menú en $array_menu
            if (!isset($array_menu[$value->id_menu])) {
                // Si no existe, inicializa el menú
                $array_menu[$value->id_menu] = [
                    'menu' => $value->menu,
                    'icon' => $value->menu_icon,
                    'modulos' => [] // Inicializa el arreglo de módulos vacío
                ];
            }

            // Agrega el módulo al menú existente
            $array_menu[$value->id_menu]['modulos'][] = [
                'modulo' => $value->modulo,
                'icon' => $value->modulo_icon,
                'ruta'  => $value->modulo_ruta
            ];
        }
    }
    
    return $array_menu;
}

function breadcrumb(){
    $route = Request::route()->getName();

    switch (gettype($route)) {
        case 'string':
            return ['HOME', 'principal'];
            break;
        
        default:
            return explode('.', $route);
            break;
    }
}

?>