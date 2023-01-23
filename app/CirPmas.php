<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CirPmas extends Model
{
  /**
   * La tabla asociada a este modelo.
   *
   * @var string
   */
  protected $table = 'cir_pmas';

  /**
   * Definir la clave primaria.
   *
   * @var string
   */
  protected $primaryKey = 'PMA_varHojaTramite';

  /**
   * Marcar la clave primaria como no autoincremental.
   *
   * @var string
   */
  public $incrementing = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id_monumento', 'otro_origen', 'codigo_caja', 'anexo', 'centro_poblado', 'documento_ingreso',
  ];

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = [
    'ubigeo', 'periodo', 'ubicacion', 'modalidad_intervencion', 'nombre', 'origen', 'nombre_responsable', 'departamento', 'provincia', 'distrito',
  ];

  /**
   * Recuperar el Responsable del Proyecto.
   */
  public function responsable()
  {
    return $this->belongsTo('App\Personas', 'PERS_varDNI');
  }

  /**
   * Recuperar el Monumento del Proyecto.
   */
  public function monumento()
  {
    return $this->belongsTo('App\Monumentos', 'id_monumento');
  }

  /**
   * Recuperar el GMCPCAM Inventario del Proyecto.
   */
  public function gmcpcamInventarios()
  {
    return $this->morphMany('App\GmcpcamInventarios', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Montaje en Panel del Proyecto.
   */
  public function gicpbamMontajesPanel()
  {
    return $this->morphMany('App\GicpbamMontajesPanel', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el análisis bioarqueológico del PMA.
   */
  public function gafAnalisisBioarqueologico()
  {
    return $this->morphMany('App\GafAnalisisBioarqueologicos', 'proyecto', 'tipo_proyecto', 'id_proyecto');
  }

  /**
   * Recuperar el Origen del Proyecto.
   */
  public function getOrigenAttribute()
  {
    return $this->monumento ? $this->monumento->MONU_varCategoria . ' ' . $this->monumento->MONU_varNombre
                              : ($this->otro_origen ? $this->otro_origen : $this->nombre);
  }

  /**
   * Recuperar el Ubigeo del Proyecto.
   */
  public function getUbigeoAttribute()
  {
    try {
      return Ubigeos::where('UBIG_varNombre', $this->UBIG_varDistrito)
                    ->whereRaw("LEFT(UBIG_varDistritoId, 2) <> '00'")
                    ->firstOrFail()->UBIG_varId;
    } catch (\Exception $e) {
      return null;
    }
  }

  /**
   * Recuperar la ubicación del Proyecto.
   */
  public function getUbicacionAttribute()
  {
    $ubicacion = '';
    if ($this->monumento) {
      $ubicacion .= $this->monumento->MONU_varCategoria . ' ' . $this->monumento->MONU_varNombre . ' - ';
    } else {
      $ubicacion .= $this->otro_origen ? ($this->otro_origen . ' - ') : '';
    }
    $ubicacion .= implode(', ', [$this->UBIG_varDepartamento, $this->UBIG_varProvincia, $this->UBIG_varDistrito]);
    return $ubicacion;
  }

  /*
   * Recuperar el período del Proyecto.
   */
  public function getPeriodoAttribute()
  {
    return $this->PMA_varPeriodo;
  }

  /*
   * Recuperar la modalidad de intervención del proyecto.
   */
  public function getModalidadIntervencionAttribute()
  {
    return 'PMA';
  }

  /*
   * Recuperar el nombre del proyecto.
   */
  public function getNombreAttribute()
  {
    return $this->PMA_varNombreProyecto;
  }

  /*
   * Recuperar el nombre del responsable del proyecto.
   */
  public function getNombreResponsableAttribute()
  {
    return $this->responsable->nombre_completo;
  }

  public function getDepartamentoAttribute()
  {
    return $this->UBIG_varDepartamento;
  }

  public function getProvinciaAttribute()
  {
    return $this->UBIG_varProvincia;
  }

  public function getDistritoAttribute()
  {
    return $this->UBIG_varDistrito;
  }
}
