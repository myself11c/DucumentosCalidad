<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    //
    public function ListDirectory(){
        $proceso='PE-01-Gestion-Estrategica-y-de-Calidad';
    // directorio de calidad en `/storage/app/public/docs`
    // Obtienes los subdirectorios que están dentro del directorio del cliente
    $directorios_del_proceso = Storage::allfiles("/public/docs/{$proceso}");
    $exp='(.*?)\.(jpg|png|jpeg|gif)$';
    // creas un array vacío para ir llenándolo con los elementos año/mes/archivos
    $tree_array = [];
    //if($archivo=='.' or $archivo=='..' or $archivo=='index.php' or $archivo=='otro.HTM' or $archivo=='Thumbs.db')
    
    // iteras sobre los directorios obtenidos
    foreach ($directorios_del_proceso as $directorio_del_proceso) {
        $temp_array = explode('/', $directorio_del_proceso);
        // obtienes el último elemento (el nombre del archivo).
        $filename = end( $temp_array );
        // obtienes la url que corresponde a ese archivo.
        $url = Storage::url($directorio_del_proceso);
        $directorio=$temp_array[3];
        // guardas en tu array el nombre y la url del archivo, 
        // haciendo que el array sea multidimensional por año y mes.
        
        if($filename == '.' || $filename == '..' || $filename == 'index.php' || $filename == '.DS_Store'){
            //TODO: No hacer nada
        }else{
            $ext_arr=explode('.',$filename);
            $ext=end($ext_arr);
            //Se define icono del archivo
            if($ext=='xls'|| $ext=='xlsx'){
                $ico='http://caminosips.com/img_calidad/excel.png'; 
            }
            if($ext=='doc'|| $ext=='docx'){
                $ico='http://caminosips.com/img_calidad/word.png'; 
            }
            if($ext=='ppt'|| $ext=='pptx'){
                $ico='http://caminosips.com/img_calidad/ppt.png'; 
            }
            if($ext=='pdf'){
               $ico='http://caminosips.com/img_calidad/pdf.png'; 
            }

            $tree_array[$proceso][$directorio][] = [
                'filename' => $filename,
                'url' => $url,
                'ico' => $ico
            ];
        }
        
    }
    
    // devuelves la vista pasándole el array creado.
    return view('viewFolder', ['tree_array' => $tree_array]);
    }
}
