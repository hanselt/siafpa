<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UsuarioFichas extends Authenticatable
{
  use Notifiable;
  use HasRoles;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'usuarios_fichas';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'estado',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function setPasswordAttribute($value)
  {
    if (!empty($value)) {
      $this->attributes['password'] = \Hash::make($value);
    }
  }
}
