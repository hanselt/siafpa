<?php

namespace App\Http\Controllers;

use App\DfqAnalisisAguas;
use App\DfqAnalisisCeramicos;
use App\DfqAnalisisLiticos;
use App\DfqAnalisisMateriales;
use App\DfqAnalisisMetales;
use App\GafAnalisisBioarqueologicos;
use App\GicpbamAnalisisMuestras;
use App\GicpbamConservaciones;
use App\GicpbamControlesHumedad;
use App\GicpbamDibujosTecnicos;
use App\GicpbamFragmentos;
use App\GicpbamInventarios;
use App\GicpbamInventarioDetalles;
use App\GicpbamMontajesPanel;
use App\GicpbamMovimientosFragmento;
use App\GmcpcamCatalogaciones;
use App\GmcpcamDiagnosticos;
use App\GmcpcamIntervenciones;
use App\GmcpcamInventarios;
use App\Http\Controllers\GmcpcamController;
use App\Http\Controllers\HerramientasController;
use DB;
use Illuminate\Http\Request;
use SnappyPdf;

class FichasController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request, $gabinete, $tipo)
  {
    if ($request->ajax()) {
      $q = null;
      $resultados = null;
      $page_size = 10;
      $paginar = true;
      switch ($gabinete) {
        case 'gmcpcam': {
          switch ($tipo) {
            case 'inventario': {
              $q = GmcpcamInventarios::with(['proyecto', 'detalle.estadoConservacion', 'registrador']);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'catalogacion': {
              $q = GmcpcamCatalogaciones::with([
                'material', 'detalleInventario.inventario.proyecto', 'detalleInventario.inventario.detalle', 'material', 'bienCultural', 'tipo', 'especie', 'clase', 'culturaEstilo', 'cronologia', 'funcionUso', 'estadoConservacion', 'estadoIntegridad', 'fotografias', 'registrador', 'catalogador'
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->detalleInventario->inventario->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'diagnostico': {
              $q = GmcpcamDiagnosticos::with([
                'catalogacion.material', 'catalogacion.detalleInventario.inventario.proyecto', 'catalogacion.bienCultural', 'diagnosticoEstado', 'catalogacion.culturaEstilo', 'catalogacion.cronologia'
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'proyecto') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->catalogacion->detalleInventario->inventario->proyecto->nombre, $request->texto);
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } elseif ($request->columna === 'codigo') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->catalogacion->codigo_bien, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            case 'intervencion': {
              $q = GmcpcamIntervenciones::with([
                'catalogacion.material', 'catalogacion.bienCultural', 'catalogacion.culturaEstilo', 'catalogacion.cronologia', 'catalogacion.detalleInventario.inventario.proyecto', 'fotografias',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'proyecto') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->catalogacion->detalleInventario->inventario->proyecto->nombre, $request->texto);
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } elseif ($request->columna === 'codigo') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->catalogacion->codigo_bien, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            default:
            return [];
            break;
          }
          break;
        }
        case 'gicpbam': {
          switch ($tipo) {
            case 'ceramologico': {
              $q = GicpbamFragmentos::with([
                'detalleInventario.inventario.proyecto', 'detalleInventario.inventario.detalle', 'formaVasija',
                'estilo', 'tecnicaSuperficieExterna', 'tecnicaSuperficieInterna', 'motivosSuperficieExterna',
                'motivosSuperficieInterna', 'labio', 'borde', 'cuello', 'cuerpo', 'asa', 'base', 'mango', 'soporte',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->detalleInventario->inventario->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'conservacion': {
              $q = GicpbamConservaciones::with([
                'fragmento.detalleInventario.inventario.proyecto', 'fragmento.estilo', 'estadoConservacion', 'fotografias'
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'proyecto') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->detalleInventario->inventario->proyecto->nombre, $request->texto);
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } elseif ($request->columna === 'codigo_fragmento') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->codigo_fragmento, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            case 'dibujo_tecnico': {
              $q = GicpbamDibujosTecnicos::with([
                'fragmento.detalleInventario.inventario.proyecto', 'fragmento.estilo', 'tipoDigitalizacion', 'fragmento.formaVasija',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'proyecto') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->detalleInventario->inventario->proyecto->nombre, $request->texto);
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } elseif ($request->columna === 'codigo_fragmento') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->codigo_fragmento, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            case 'analisis_muestras': {
              $q = GicpbamAnalisisMuestras::with([
                'fragmento.detalleInventario.inventario.proyecto'
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'codigo_fragmento') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->codigo_fragmento, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            case 'montaje': {
              $q = GicpbamMontajesPanel::with([
                'proyecto', 'estadoConservacionPanel',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'control_humedad': {
              $q = GicpbamControlesHumedad::with([
                'espacioMonitoreado',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'espacio_monitoreado') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->espacioMonitoreado->denominacion, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'movimiento': {
              $q = GicpbamMovimientosFragmento::with([
                'fragmento.detalleInventario.inventario.proyecto', 'fragmento.estilo',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto')) {
                if ($request->columna === 'codigo_fragmento') {
                  $paginar = false;
                  $filtrado = $q->get()->filter(function ($value) use ($request) {
                    $r = stripos($value->fragmento->codigo_fragmento, strval($request->texto));
                    return $r || $r === 0;
                  });
                  $resultados = $this::paginar($filtrado, $page_size, $request->page);
                } else {
                  $texto = '%' . $request->texto . '%';
                  $q->where($request->columna, 'like', $texto);
                }
              }
              break;
            }
            default:
            return [];
            break;
          }
          break;
        }
        case 'gaf': {
          switch ($tipo) {
            case 'inventario_oseo_humano': {
              $q = GafAnalisisBioarqueologicos::with([
                'proyecto', 'estadoConservacionCraneo', 'estadoConservacionExtremidadesSuperiores', 'estadoConservacionExtremidadesInferiores', 'estadoConservacionCostillas', 'estadoConservacionVertebras', 'estadoConservacionEsternon', 'estadoConservacionPelvis', 'estadoConservacionSacro',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            default:
            return [];
            break;
          }
          break;
        }
        case 'dfq': {
          switch ($tipo) {
            case 'analisis_material_litico': {
              $q = DfqAnalisisLiticos::with([
                'proyecto',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'analisis_metales': {
              $q = DfqAnalisisMetales::with([
                'proyecto', 'morfologia', 'fotografias',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'analisis_materiales': {
              $q = DfqAnalisisMateriales::with([
                'proyecto', 'fotografias',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'analisis_materiales_ceramicos': {
              $q = DfqAnalisisCeramicos::with([
                'proyecto', 'estadoConservacion',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            case 'analisis_aguas': {
              $q = DfqAnalisisAguas::with([
                'proyecto', 'fotografias',
              ]);
              // Filtrar según búsqueda
              if ($request->has('columna') && $request->has('texto') && $request->columna !== 'proyecto') {
                $texto = '%' . $request->texto . '%';
                $q->where($request->columna, 'like', $texto);
              } elseif ($request->has('columna') && $request->has('texto')) {
                $paginar = false;
                $filtrado = $q->get()->filter(function ($value) use ($request) {
                  $r = stripos($value->proyecto->nombre, $request->texto);
                  return $r || $r === 0;
                });
                $resultados = $this::paginar($filtrado, $page_size, $request->page);
              }
              break;
            }
            default:
            return [];
            break;
          }
          break;
        }
        default:
        return [];
        break;
      }
      if ($paginar) {
        $resultados = $q->paginate($page_size);
        return [
          'pagination' => [
            'total' => $resultados->total(),
            'per_page' => $resultados->perPage(),
            'current_page' => $resultados->currentPage(),
            'last_page' => $resultados->lastPage(),
            'from' => $resultados->firstItem(),
            'to' => $resultados->lastItem()
          ],
          'data' => $resultados
        ];
      } else {
        return $resultados;
      }
    } else {
      $vista = $gabinete . '.' . $tipo;
      if (view()->exists($vista)) {
        return view($vista);
      } else {
        return redirect('/');
      }
    }
  }

  public function create($gabinete, $tipo)
  {
    $vista = $gabinete . '.crear.' . $tipo;
    if (view()->exists($vista)) {
      return view($vista);
    } else {
      return redirect('/');
    }
  }

  public function datos($gabinete, $ficha)
  {
    try {
      $respuesta = [];
      switch ($gabinete) {
        case 'gmcpcam':
        switch ($ficha) {
          case 'catalogacion': {
            $respuesta['ficha_inventario'] = GmcpcamInventarios::with([
              'detalle', 'proyecto'
            ])->findOrFail(session('id_gmcpcam_inventario'));
            $respuesta['ficha_inventario']['ubigeo'] = HerramientasController::ubigeoDistrito($respuesta['ficha_inventario']['proyecto']['UBIG_varDistrito']);
          }
          break;
          case 'diagnostico':
          case 'intervencion':
          $respuesta['ficha_catalogacion'] = GmcpcamCatalogaciones::with(
            ['material', 'detalleInventario.inventario.proyecto', 'bienCultural', 'culturaEstilo', 'cronologia'
          ])->findOrFail(session('id_gmcpcam_catalogacion'));
          break;
          default:
          break;
        }
        break;
        case 'gicpbam':
        switch ($ficha) {
          case 'ceramologico':
          $respuesta['inventario'] = GmcpcamInventarios::with(['detalle', 'proyecto'])->find(session('id_gicpbam_inventario'));
          break;
          case 'conservacion':
          $fragmento = GicpbamFragmentos::with([
            'detalleInventario.inventario.proyecto', 'estilo'
          ])->find(session('id_gicpbam_analisis_ceramologico'));
          $respuesta['fragmento'] = $fragmento;
          break;
          case 'dibujo_tecnico':
          $fragmento = GicpbamFragmentos::with([
            'detalleInventario.inventario.proyecto', 'estilo', 'formaVasija'
          ])->find(session('id_gicpbam_analisis_ceramologico'));
          $respuesta['fragmento'] = $fragmento;
          break;
          case 'analisis_muestras':
          $fragmento = GicpbamFragmentos::with(['detalleInventario.inventario.proyecto', 'estilo'])->find(session('id_gicpbam_analisis_ceramologico'));
          $respuesta['fragmento'] = $fragmento;
          break;
          case 'movimiento':
          $respuesta['fragmento'] = GicpbamFragmentos::with([
            'detalleInventario.inventario.proyecto', 'estilo',
          ])->find(session('id_gicpbam_analisis_ceramologico'));;
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

  public function guardar(Request $request, $gabinete, $ficha)
  {
    $respuesta = [];
    switch ($gabinete) {
      case 'gmcpcam':
      switch ($ficha) {
        case 'inventario':
        $respuesta['resultado'] = GmcpcamController::guardarFichaInventario($request, $respuesta);
        break;
        case 'catalogacion':
        $respuesta['resultado'] = GmcpcamController::guardarFichaCatalogacion($request, $respuesta);
        break;
        case 'diagnostico':
        $respuesta['resultado'] = GmcpcamController::guardarFichaDiagnostico($request, $respuesta);
        break;
        case 'intervencion':
        $respuesta['resultado'] = GmcpcamController::guardarFichaIntervencion($request, $respuesta);
        break;
        default:
        break;
      }
      break;
      case 'gicpbam': {
        switch ($ficha) {
          case 'inventario':
          $respuesta['resultado'] = GicpbamController::guardarFichaInventario($request, $respuesta);
          break;
          case 'ceramologico':
          $respuesta['resultado'] = GicpbamController::guardarAnalisisCeramologico($request, $respuesta);
          break;
          case 'conservacion':
          $respuesta['resultado'] = GicpbamController::guardarConservacion($request, $respuesta);
          break;
          case 'dibujo_tecnico':
          $respuesta['resultado'] = GicpbamController::guardarDibujoTecnico($request, $respuesta);
          break;
          case 'analisis_muestras':
          $respuesta['resultado'] = GicpbamController::guardarAnalisisMuestras($request, $respuesta);
          break;
          case 'montaje':
          $respuesta['resultado'] = GicpbamController::guardarMontajePanel($request, $respuesta);
          break;
          case 'control_humedad':
          $respuesta['resultado'] = GicpbamController::guardarControlHumedad($request, $respuesta);
          break;
          case 'movimiento':
          $respuesta['resultado'] = GicpbamController::guardarMovimientoFragmento($request, $respuesta);
          break;
          default:
          break;
        }
        break;
      }
      case 'gaf': {
        switch ($ficha) {
          case 'inventario_oseo_humano':
          $respuesta['resultado'] = GafController::guardarFichaInventario($request, $respuesta);
          break;
          default:
          break;
        }
        break;
      }
      case 'dfq': {
        switch ($ficha) {
          case 'analisis_material_litico':
          $respuesta['resultado'] = DfqController::guardarAnalisisLitico($request, $respuesta);
          break;
          case 'analisis_metales':
          $respuesta['resultado'] = DfqController::guardarAnalisisMetales($request, $respuesta);
          break;
          case 'analisis_materiales':
          $respuesta['resultado'] = DfqController::guardarAnalisisMateriales($request, $respuesta);
          break;
          case 'analisis_materiales_ceramicos':
          $respuesta['resultado'] = DfqController::guardarAnalisisCeramico($request, $respuesta);
          break;
          case 'analisis_aguas':
          $respuesta['resultado'] = DfqController::guardarAnalisisAguas($request, $respuesta);
          break;
          default:
          break;
        }
        break;
      }
      default:
      break;
    }
    return $respuesta;
  }

  public function crearFichaDependiente($gabinete, $tipo, $dependencia, $id_ficha)
  {
    // Almacenar el id de la ficha en la dependencia respectiva
    $clave = 'id_'. $gabinete . '_' . $dependencia;
    session([$clave => $id_ficha]);
    // Redireccionar a la vista
    $vista = $gabinete . '.crear.dependiente.' . $tipo;
    if (view()->exists($vista)) {
      return view($vista);
    } else {
      return redirect('/');
    }
  }

  public function reporte($gabinete, $tipo, $id_ficha)
  {
    try {
      $vista = $gabinete . '.reportes.' . $tipo;
      $datos = null;
      $datos_extra = [];
      $ficha = '';
      $horizontal = false;
      $ruta_header = 'gmcpcam.reportes.partials.header';
      $ruta_footer = 'gmcpcam.reportes.partials.footer';
      $footer_right = '';
      // De acuerdo al gabinete y tipo de ficha, modificar los valores necesarios
      switch ($gabinete) {
        case 'gmcpcam': {
          switch ($tipo) {
            case 'inventario': {
              $datos = GmcpcamInventarios::findOrFail($id_ficha);
              $ficha = 'FICHA C';
              $horizontal = true;
              break;
            }
            case 'catalogacion': {
              $datos = GmcpcamCatalogaciones::findOrFail($id_ficha);
              $ficha = 'FICHA D';
              break;
            }
            case 'diagnostico': {
              $datos = GmcpcamDiagnosticos::findOrFail($id_ficha);
              $ficha = 'FICHA F1';
              break;
            }
            case 'intervencion': {
              $datos = GmcpcamIntervenciones::findOrFail($id_ficha);
              $ficha = 'FICHA F2';
              break;
            }
            default:
            break;
          }
          break;
        }
        case 'gicpbam': {
          switch ($tipo) {
            case 'inventario_f2': {
              $datos = GmcpcamInventarios::findOrFail($id_ficha)->detalle;//->skip()->take(1);
              break;
            }
            case 'analisis_ceramologico': {
              $datos = GicpbamFragmentos::findOrFail($id_ficha);
              break;
            }
            case 'conservacion': {
              $datos = GicpbamConservaciones::findOrFail($id_ficha);
              break;
            }
            case 'dibujo_tecnico': {
              $datos = GicpbamDibujosTecnicos::findOrFail($id_ficha);
              break;
            }
            case 'analisis_muestras': {
              $datos = GicpbamAnalisisMuestras::findOrFail($id_ficha);
              break;
            }
            case 'montaje': {
              $datos = GicpbamMontajesPanel::findOrFail($id_ficha);
              break;
            }
            case 'control_humedad': {
              $datos = GicpbamControlesHumedad::findOrFail($id_ficha);
              break;
            }
            case 'movimiento': {
              $datos = GicpbamMovimientosFragmento::findOrFail($id_ficha);
              break;
            }
            default:
            break;
          }
          $footer_right = 'GICPBAM - CERAMOTECA';
          break;
        }
        case 'gaf': {
          switch ($tipo) {
            case 'inventario_oseo_humano': {
              $datos = GafAnalisisBioarqueologicos::findOrFail($id_ficha);
              break;
            }
            default:
            break;
          }
          break;
        }
        case 'dfq': {
          switch ($tipo) {
            case 'analisis_material_litico': {
              $datos = DfqAnalisisLiticos::findOrFail($id_ficha);
              break;
            }
            case 'analisis_metales': {
              $datos = DfqAnalisisMetales::findOrFail($id_ficha);
              break;
            }
            case 'analisis_materiales': {
              $datos = DfqAnalisisMateriales::findOrFail($id_ficha);
              break;
            }
            case 'analisis_materiales_ceramicos': {
              $datos = DfqAnalisisCeramicos::findOrFail($id_ficha);
              break;
            }
            case 'analisis_aguas': {
              $datos = DfqAnalisisAguas::findOrFail($id_ficha);
              break;
            }
            default:
            break;
          }
          break;
        }
        default:
        break;
      }
        // Recuperar las vistas del header y footer compilada
      $header = \View::make($ruta_header, [ "ficha" => $ficha ]);
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

  /*
   * Método para actualizar los datos de una ficha
   */
  public function actualizar(Request $request, $gabinete, $ficha)
  {
    $respuesta = [];
    switch ($gabinete) {
      case 'gmcpcam':
      switch ($ficha) {
        case 'inventario':
        $respuesta['resultado'] = GmcpcamController::actualizarFichaInventario($request, $respuesta);
        break;
        case 'catalogacion':
        $respuesta['resultado'] = GmcpcamController::actualizarFichaCatalogacion($request, $respuesta);
        break;
        case 'diagnostico':
        $respuesta['resultado'] = GmcpcamController::actualizarFichaDiagnostico($request, $respuesta);
        break;
        case 'intervencion':
        $respuesta['resultado'] = GmcpcamController::actualizarFichaIntervencion($request, $respuesta);
        break;
        default:
        break;
      }
      break;
      case 'gicpbam':
      switch ($ficha) {
        case 'inventario':
        $respuesta['resultado'] = GicpbamController::actualizarFichaInventario($request, $respuesta);
        break;
        case 'ceramologico':
        $respuesta['resultado'] = GicpbamController::actualizarAnalisisCeramologico($request, $respuesta);
        break;
        case 'conservacion':
        $respuesta['resultado'] = GicpbamController::actualizarConservacion($request, $respuesta);
        break;
        case 'dibujo_tecnico':
        $respuesta['resultado'] = GicpbamController::actualizarDibujoTecnico($request, $respuesta);
        break;
        case 'analisis_muestras':
        $respuesta['resultado'] = GicpbamController::actualizarAnalisisMuestras($request, $respuesta);
        break;
        case 'montaje':
        $respuesta['resultado'] = GicpbamController::actualizarMontajePanel($request, $respuesta);
        break;
        case 'control_humedad':
        $respuesta['resultado'] = GicpbamController::actualizarControlHumedad($request, $respuesta);
        break;
        case 'movimiento':
        $respuesta['resultado'] = GicpbamController::actualizarMovimientoFragmento($request, $respuesta);
        break;
      }
      break;
      case 'gaf': {
        switch ($ficha) {
          case 'inventario_oseo_humano':
          $respuesta['resultado'] = GafController::actualizarFichaInventario($request, $respuesta);
          break;
          default:
          break;
        }
        break;
      }
      case 'dfq': {
        switch ($ficha) {
          case 'analisis_material_litico':
          $respuesta['resultado'] = DfqController::actualizarAnalisisLitico($request, $respuesta);
          break;
          case 'analisis_metales':
          $respuesta['resultado'] = DfqController::actualizarAnalisisMetales($request, $respuesta);
          break;
          case 'analisis_materiales':
          $respuesta['resultado'] = DfqController::actualizarAnalisisMateriales($request, $respuesta);
          break;
          case 'analisis_materiales_ceramicos':
          $respuesta['resultado'] = DfqController::actualizarAnalisisCeramico($request, $respuesta);
          break;
          default:
          break;
        }
        break;
      }
      default:
      break;
    }
    return $respuesta;
  }

  public function paginar($filtrado, $page_size, $current_page)
  {
    $total = $filtrado->count();
    $paginas = $filtrado->chunk($page_size)->toArray();
    return [
      'pagination' => [
        'total' => $total,
        'per_page' => $page_size,
        'current_page' => $current_page,
        'last_page' => count($paginas),
        'from' => $total ? ($current_page - 1) * $page_size + 1 : null,
        'to' => $total ? $current_page * $page_size : null,
      ],
      'data' => [ 'data' => $total ? $paginas[$current_page - 1] : []],
    ];
  }
}
