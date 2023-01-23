<?php

namespace App\Http\Controllers;

use App\Ubigeos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HerramientasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public static function normalizarNombreArchivo($nombre)
  {
    $acentos = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
    $nombre_codificado = htmlentities($nombre, ENT_NOQUOTES, 'UTF-8');
    $nombre = preg_replace($acentos, '$1', $nombre_codificado);
    return $nombre;
  }

  public function dropzoneSubir(Request $request, $gabinete, $tipo_ficha)
  {
    $archivo = $request->file('fotografia');
    $carpeta = public_path() . '/uploads/' . $gabinete . '/' . $tipo_ficha;
    $nombre_archivo = date('Y-m-d-h-i-s') . '-' . $this->normalizarNombreArchivo($archivo->getClientOriginalName());
    $archivo->move($carpeta, $nombre_archivo);
    return '/uploads/' . $gabinete . '/' . $tipo_ficha . '/' . $nombre_archivo;
  }

  /*
   * Borrar una imagen subida anteriormente.
   */
  public function dropzoneBorrar(Request $request, $gabinete, $tipo_ficha, $nombre_fotografia)
  {
    $archivo = $gabinete . '/' . $tipo_ficha . '/' . $nombre_fotografia;
    return Storage::disk('uploads')->delete($archivo) ? 'Archivo borrado.' : 'No se pudo borrar el archivo';
  }

  public function ubigeo(Request $request, $codigo)
  {
    $respuesta = [];
    // Recuperar de archivo local
    $ruta = storage_path('app/json/ubigeo.min.json');
    $json = json_decode(file_get_contents($ruta), true);

    if (array_key_exists($codigo, $json)) {
      $respuesta = [
        "departamento" => $json[$codigo]["departamento"],
        "provincia" => $json[$codigo]["provincia"],
        "distrito" => $json[$codigo]["distrito"],
        "resultado" => true,
      ];
    } else {
      $respuesta = [
        'resultado' => false,
        'mensaje' => "Código no corresponde a ningún distrito.",
      ];
    }
    return $respuesta;
  }

  public static function ubigeoDistrito($distrito)
  {
    try {
      return Ubigeos::where('UBIG_varNombre', $distrito)
                    ->whereRaw("LEFT(UBIG_varDistritoId, 2) <> '00'")
                    ->firstOrFail()->UBIG_varId;
    } catch (\Exception $e) {
      return null;
    }
  }

  /*
  public function tests()
  {
    var_dump(php_uname('s'));
    var_dump(php_uname('m'));
  }
  */

}
