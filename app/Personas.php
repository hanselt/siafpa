<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
  protected $table = 'gen_personas';

  /**
   * Definir la clave primaria.
   *
   * @var string
   */
  protected $primaryKey = 'PERS_varDNI';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'iniciales', 'coarpe',
  ];

  /**
   * Definir los campos que no se deben retornar en las consultas.
   *
   * @var string
   */
  protected $hidden = [
    'PERS_varTipo', 'PERS_varCargo', 'PERS_varDescription', 'PERS_varDirImagen', 'created_at', 'updated_at'
  ];

  /**
   * Accesores adicionales a retornar con las consultas.
   *
   * @var array
   */
  protected $appends = ['nombre_completo', 'rna_coarpe',];

  /**
   * Recuperar el nombre completo de la Persona.
   */
  public function getNombreCompletoAttribute()
  {
    return implode(' ', [$this->PERS_varGradoAcademico, $this->PERS_varNombres, $this->PERS_varApPaterno, $this->PERS_varApMaterno]);
  }

  /**
   * Recuperar el RNA / COARPE de la Persona.
   */
  public function getRnaCoarpeAttribute()
  {
    return implode('/', [$this->PERS_varRna, $this->coarpe]);
  }
}
