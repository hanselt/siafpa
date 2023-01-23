<?php

namespace App\Http\Controllers;

use App\GicpbamControlesHumedad;
use Illuminate\Http\Request;
use SnappyPdf;

class ReportesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /*
   * Método para mostrar la vista que genera el reporte para los diferentes procesos.
   */
  public function index($gabinete, $tipo)
  {
    $vista = 'reportes.' . $gabinete . '.' . $tipo . '.index';
    if (view()->exists($vista)) {
      return view($vista);
    } else {
      return redirect('/');
    }
  }

  /*
   * Método para generar el reporte solicitado.
   */
  public function generar(Request $request, $gabinete, $tipo, $tipo_reporte)
  {
    try {
      $respuesta = [];
      switch ($gabinete) {
        case 'gmcpcam':
          switch ($tipo) {
            case 'catalogacion':
              break;
            case 'diagnostico':
              break;
            case 'intervencion':
              break;
            default:
              break;
          }
          break;
        case 'gicpbam':
          switch ($tipo) {
            case 'ceramologico':
              break;
            case 'conservacion':
              break;
            case 'dibujo_tecnico':
              break;
            case 'analisis_muestras':
              break;
            case 'control_humedad':
              $respuesta = GicpbamControlesHumedad::datosReporte($tipo_reporte, $request->anio, $request->mes);
              break;
            default:
              break;
          }
          break;
        default:
          break;
      }
      return $respuesta;
    } catch (\Exception $e) {
      return response(['mensaje' =>  $e->getMessage()], $status = 404);
    }
  }

  public function generarPdf($gabinete, $tipo, $tipo_reporte, $params)
  {
    try {
      $params = explode('/', $params);
      $vista = 'reportes.' . $gabinete . '.' . $tipo . '.pdf.' . $tipo_reporte ;
      $datos = null;
      $datos_extra = null;
      $ficha = '';
      $horizontal = false;
      $ruta_header = 'gmcpcam.reportes.partials.header';
      $ruta_footer = 'gmcpcam.reportes.partials.footer';
      $footer_right = '';
      // De acuerdo al gabinete y tipo de ficha, modificar los valores necesarios
      switch ($gabinete) {
        case 'gmcpcam': {
          switch ($tipo) {
            case 'inventario':
              break;
            case 'catalogacion':
              break;
            case 'diagnostico':
              break;
            case 'intervencion':
              break;
            default:
              break;
          }
          break;
        }
        case 'gicpbam': {
          switch ($tipo) {
            case 'inventario':
              break;
            case 'inventario_f2':
              break;
            case 'analisis_ceramologico':
              break;
            case 'conservacion':
              break;
            case 'dibujo_tecnico':
              break;
            case 'analisis_muestras':
              break;
            case 'montaje':
              break;
            case 'control_humedad':
              $datos = GicpbamControlesHumedad::datosReporte($tipo_reporte, $params[0], $params[1]);
              $horizontal = true;
              break;
            case 'movimiento':
              break;
            default:
              break;
          }
          $footer_right = 'GICPBAM - CERAMOTECA';
          break;
        }
        default:
          break;
      }
      // Recuperar las vistas del header y footer compilada
      $header = \View::make($ruta_header, [ 'ficha' => $ficha ]);
      $footer = \View::make($ruta_footer, [ 'footer_right' => $footer_right ]);
      // Generar reporte
      if (view()->exists($vista)) {
        $pdf = SnappyPdf::loadView($vista, [ 'datos' => $datos, 'datos_extra' => $datos_extra ])
                        ->setOption('header-html', $header)
                        ->setOption('header-spacing', 2)
                        ->setOption('footer-html', $footer);
        if ($horizontal) {
          $pdf->setPaper('a4','landscape');
        }
        return $pdf->stream();
      } else {
        return redirect('/');
      }
    } catch (\Exception $e) {
      return dd($e);
    }
  }
}
