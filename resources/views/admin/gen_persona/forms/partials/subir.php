<?php

$archivo = $_FILES['file'];

$templocation = $archivo["tmp_name"];
$name = $archivo["name"];


if(!$templocation){
    die('NO ha seleccionado ningun archivo');
}

if(move_uploaded_file($templocation, "../../../../../public/archivos/general/personas/$name")){
    echo "Archivo guardado correctamente";
}else{
    echo "Error al guardar el archivo";
}

?>