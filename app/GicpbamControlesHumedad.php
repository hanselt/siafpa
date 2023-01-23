<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GicpbamControlesHumedad extends Model
{
  /**
   * SoftDeletes permite que los registros de la tabla no sean borrados permanentemente por defecto.
   * Esto mantiene la consistencia del índice y permite recuperar en caso de borrado por error.
   */
  use SoftDeletes;

  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'gicpbam_controles_humedad';

  /*
   * Atributos asignables
   */
  protected $fillable = [
    'espacio_monitoreado',
    'humedad',
    'temperatura',
    'fecha',
    'hora',
    'registrador',
    'observaciones',
  ];

  /*
   * Atributos que no se devuelven en las consultas
   */
  protected $hidden = [ 'created_at', 'updated_at', 'deleted_at' ];

  /*
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'nro_ficha',
  ];

  /*
   * Recuperar el Espacio Monitoreado del Control de Humedad.
   */
  public function espacioMonitoreado()
  {
    return $this->belongsTo('App\Terminos', 'espacio_monitoreado');
  }

  /*
   * Recuperar el registrador del Control de Humedad.
   */
  public function registrador()
  {
    return $this->belongsTo('App\UsuarioFichas', 'registrador');
  }

  /*
   * Recuperar Nro. de Ficha.
   */
  public function getNroFichaAttribute()
  {
    $anio = date('Y', strtotime($this->created_at));
    $nro_ficha = GicpbamControlesHumedad::whereYear('created_at', '=', $anio)
                                        ->where('id', '<', $this->id)
                                        ->count() + 1;
    return str_pad($nro_ficha, 5, '0', STR_PAD_LEFT) . ' - ' . $anio;
  }

  /*
   * Método para retornar los datos para un reporte
   */
  public static function datosReporte($tipo, $anio, $mes)
  {
    $respuesta = [];
    switch ($tipo) {
      case 'general':
        $datos = GicpbamControlesHumedad::whereYear('fecha', $anio)
                                        ->whereMonth('fecha', $mes)
                                        ->with('espacioMonitoreado')
                                        ->get()->toArray();
        $respuesta['espacios_monitoreados'] = array_unique(array_map(function ($elem) {
          return $elem['espacio_monitoreado']['denominacion'];
        }, $datos));
        $tmp = array_unique(array_map(function ($elem) {
            return $elem['fecha'];
        }, $datos));
        sort($tmp);
        $respuesta['fechas'] = $tmp;
        // Generar la transformada
        $lista = [];
        foreach ($datos as $item) {
          // Agregar fecha a la lista
          if (!array_key_exists($item['fecha'], $lista)) {
            $lista[$item['fecha']] = [];
          }
          // Agregar hora
          $hora = $item['hora'] === 'Mañana' ? 'manana' : 'tarde';
          if (!array_key_exists($hora, $lista[$item['fecha']])) {
            $lista[$item['fecha']][$hora] = [];
          }
          // Agregar espacio
          $espacio = $item['espacio_monitoreado']['denominacion'];
          $lista[$item['fecha']][$hora][$espacio]['temperatura'] = $item['temperatura'];
          $lista[$item['fecha']][$hora][$espacio]['humedad'] = $item['humedad'];
        }
        $respuesta['transformada'] = $lista;
        break;
      default:
        break;
    }
    return $respuesta;
  }
}
