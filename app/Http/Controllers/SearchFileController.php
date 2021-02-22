<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchFile extends Controller
{
    //Busca los archivos en la ruta 
    public function RecorrerDirectory($dirr){
        $dir = "."; 
        //$dirr = "http://localhost/website/images/leyes/"; 
        $dirr = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; 
        //Directorio a recorrer. 

        $directorio=opendir($dir); 
    
        $icono='';
        echo "<br><br>"; 
        while ($archivo = readdir($directorio)){ 
        if($archivo=='.' or $archivo=='..' or $archivo=='index.php' or $archivo=='otro.HTM' or $archivo=='Thumbs.db'){ 
        echo ""; 
        }else { 
        $archivo2=str_replace(" ", "%20",$archivo);
        $enlace = $dirr.$archivo2;
            //si el nombre del archivo contiene un punto es una carpeta por lo que no es necesario quitar la extención
                if (strpos($archivo,".")) {
                    $NOMBRE = SUBSTR($archivo, 0, -4);
                    $valores = explode(".", $archivo);
                    $extension = $valores[count($valores)-1];
                    if($extension=='xls'||$extension=='xlsx'){
                        $icono='<img src="http://caminosips.com/img_calidad/excel.png" alt="" height="25" width="25"> '; 
                    }
                    if($extension=='doc'||$extension=='docx'){
                        $icono='<img src="http://caminosips.com/img_calidad/word.png" alt="" height="25" width="25"> '; 
                    }
                    if($extension=='ppt'||$extension=='pptx'){
                        $icono='<img src="http://caminosips.com/img_calidad/ppt.png" alt="" height="25" width="25"> '; 
                    }
                    if($extension=='pdf'){
                    $icono='<img src="http://caminosips.com/img_calidad/pdf.png" alt="" height="25" width="25"> '; 
                    }
                    //PowerPoint, Excel, PDF, Doc
                }else
                {
                    $NOMBRE = '<img src="http://caminosips.com/img_calidad/carpeta_.png" alt="" height="25" width="25"> '.$archivo.' ';
                }
    
        $html= "<div><ul id='navlist'><li>"; 
        $html.= "<a href=$enlace class='' style='font-family: verdana, sans-serif;
                color: #2F92D4;
                font-size: 12px;
                font-weight: bold;
                font-style: italic;
        ' >$icono $NOMBRE<br></a>"; 
    
        $html.= "</li></ul></div>"; 
    
        } 
        } 
        closedir($directorio);

    }

    public function ListDirectory(){
        $proceso='PE-01-Gestion-Estrategica-y-de-Calidad';
    // directorio del cliente en `/storage/app/public`
    $id_figura = 11;
    // Obtienes los subdirectorios que están dentro del directorio del cliente
    $directorios_del_proceso = Storage::directories("/public/docs/{$proceso}");
    // creas un array vacío para ir llenándolo con los elementos año/mes/archivos
    $tree_array = [];

    // iteras sobre los directorios obtenidos
    foreach ($directorios_del_proceso as $directorio_del_ano) {
        // haciendo un explode, separas el string en un array con cada directorio.
        $temp_array = explode('/', $directorio_del_ano);
        // obtienes el último elemento (el año).
        $elemento = end( $temp_array );
        // Obtienes los subdirectorios que están dentro del directorio del año
        $subdirectorios_del_ano = Storage::directories("/public/documentos/$id_figura/$elemento");
        foreach ($subdirectorios_del_ano as $directorio_del_mes) {
            $temp_array = explode('/', $directorio_del_mes);
            // obtienes el último elemento (el mes).
            $subfolder = end( $temp_array );
            // Obtienes los archivos que están dentro del directorio del mes
            $archivos_del_mes = Storage::files($directorio_del_mes);
            foreach ($archivos_del_mes as $archivo_del_mes) {
                $temp_array = explode('/', $archivo_del_mes);
                // obtienes el último elemento (el nombre del archivo).
                $filename = end( $temp_array );
                // obtienes la url que corresponde a ese archivo.
                $url = Storage::url($archivo_del_mes);
                // guardas en tu array el nombre y la url del archivo, 
                // haciendo que el array sea multidimensional por año y mes.
                $tree_array[$elemento][$subfolder][] = [
                    'filename' => $filename,
                    'url' => $url
                ];
            }
        }
    }

    // devuelves la vista pasándole el array creado.
    return view('viewFolder', ['tree_array' => $tree_array]);
    }
    /*$directory = public_path();
    $files = Storage::Directories('/public/documentos/'.$id_figura);
    $ultimo1 = basename($files);*/
}

  

