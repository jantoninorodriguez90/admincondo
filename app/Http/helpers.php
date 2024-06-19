<?php

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

function limpiar_cadena_texto($cadena){
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena);

    //Reemplazamos la N, n, C y c
    // $cadena = str_replace(
    // array('Ñ', 'ñ', 'Ç', 'ç'),
    // array('N', 'n', 'C', 'c'),
    // $cadena
    // );

    //SEPARAMOS LAS CADENAS EN UN ARRAY - LIMPIAMOS ESPACIOS EN BLANCOS
    $tmp_separador = explode(" ", $cadena);
    foreach ($tmp_separador as $key => $value) {
        if($value != "") $tmp_string[] = $value;
    }

    foreach ($tmp_string as $key => $value) {
        $new_cadena .= $value.' ';
    }

    
    return strtoupper(trim($new_cadena));
}

function upload_files_database($data){
    $CI =& get_instance();
    $response = ['message' => ''];		
    
    if(array_key_exists('file', $data) && array_key_exists('columns', $data) && array_key_exists('table', $data)){
        $tipo = $data['file']['type'];
        $tamano = $data['file']['size'];
        $filetemp = $data['file']['tmp_name'];
        
        switch ($tipo) {
            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                if (!empty($filetemp) && is_uploaded_file($filetemp)) {
                    require_once APPPATH."/third_party/PHPExcel.php"; 
            
                    $archivo_excel = PHPExcel_IOFactory::load($filetemp);
                    $hoja = $archivo_excel->getActiveSheet();            
            
                    try {
                        // OBTENIENDO DATOS DE LAS COLUMNAS Y FILAS EXISTENTES
                        $rango_celdas = $hoja->calculateWorksheetDimension();
                        $rangeBoundaries = PHPExcel_Cell::rangeBoundaries($rango_celdas);
                        $fila_inicio = $rangeBoundaries[0][1];
                        $columna_inicio = $rangeBoundaries[0][0];                
                        $fila_fin = $rangeBoundaries[1][1];
                        $columna_fin = $rangeBoundaries[1][0];
                        // VARIABLES PARA ARMAR LOS DATOS A INSERTAR A LA BASE DE DATOS
                        $data_columns = [];
                        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                        $columns_db = $data['columns'];
                        
            
                        // FOR PARA EMPEZAR ARMAR LOS DATOS A INSERTAR A LA BASE DE DATOS
                        // OBTNEMOS LOS DATOS DE LAS FILAS
                        for ($fila = $fila_inicio; $fila <= $fila_fin; $fila++) {                    
                            // OBETENEMOS LOS DATOS DE LAS COLUMNAS
                            for($columna = $columna_inicio; $columna <= $columna_fin; $columna++){
                                // VALIDAR SI EL REGISTRO DE EXCEL ES UN FORMATO FECHA
                                if (PHPExcel_Shared_Date::isDateTime($hoja->getCell($columns[($columna-1)]."$fila"))) {
                                    $valor_celda_excel = $hoja->getCell($columns[($columna-1)]."$fila")->getValue();
                                    $fecha_php = PHPExcel_Shared_Date::ExcelToPHP($valor_celda_excel);
                                    $fecha_php_obj = (new DateTime())->setTimestamp($fecha_php);
                                    // Sumar un día a la fecha
                                    $fecha_php_obj->add(new DateInterval('P1D'));

                                    // Almacenar la fecha formateada en el arreglo de datos
                                    $data_columns[$columns_db[($columna-1)]] = $fecha_php_obj->format('Y-m-d');
                                } else {
                                    // PROCEGUIMOS AL ALMACENAMIENTO PORQUE LA CELDA NO ES UNA FECHA
                                    $data_columns[$columns_db[($columna-1)]] = $hoja->getCell($columns[($columna-1)]."$fila")->getValue();		
                                }																
                            }                                                            
                            // INSERTAMOS LOS DATOS POR FILA A LA BASE DE DATOS
                            if($fila != 1){
                                $data_columns['id_quienregistro'] = $CI->id_usuario();
                                $CI->db->insert($data['table'], $data_columns);
                            }
                        }
                        
                        $response['message'] = 'LOS DATOS SE SUBIERON CORRECTAMENTE A LA BASE DE DATOS.';
                    } catch (Exception $e) {
                        // Manejar errores
                        $response['message'] = 'ERROR: ' . $e->getMessage();
                    }
                } else {
                    // Manejar caso en que no se subió un archivo
                    $response['message'] = 'NO SE CARGO EL ARCHIVO CORRECTAMENTE.';
                }
                break;
            
            default:
                $response['message'] = 'ERROR AL CARGAR EL ARCHIVO ¡NO VALIDO! SOLO SE PERMITE CARGAR ARCHIVOS DE EXCEL.';		
                break;
        }
    }else{
        $response['message'] = 'ES NECESARIO UTILIZAR LAS SIGUIENTES VARIABLES: file, columns, table';
    }

    

    return json_encode($response);
}

?>