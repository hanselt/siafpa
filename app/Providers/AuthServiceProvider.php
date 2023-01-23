<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    'App\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot(GateContract $gate)
  {
    $this->registerPolicies($gate);

    $gate->define('ver-menu', function ($user, $tipo) {
      $resultado = false;
      switch ($tipo) {
        case 'mantenimientos': {
          $resultado = $user->can('crear_terminos') || $user->can('ver_terminos') || $user->can('ver_monumentos') || $user->can('ver_arqueologos') || $user->can('ver_proyectos') || $user->can('ver_pmas') || $user->can('crear_usuarios') || $user->can('ver_usuarios') || $user->can('crear_roles') || $user->can('ver_roles');
          break;
        }
        case 'gmcpcam': {
          $resultado = $user->can('crear_inventario') || $user->can('ver_inventario') || $user->can('ver_catalogacion') || $user->can('ver_diagnostico') || $user->can('ver_intervencion') || $user->can('ver_ceramologico') || $user->can('ver_conservacion') || $user->can('ver_dibujo_tecnico') || $user->can('ver_resultado_analisis') || $user->can('ver_movimiento_fragmento') || $user->can('crear_montaje_panel') || $user->can('ver_montaje_panel') || $user->can('crear_control_humedad') || $user->can('ver_control_humedad');
          break;
        }
        case 'gaf': {
          $resultado = $user->can('crear_analisis_bioarqueologico') || $user->can('ver_analisis_bioarqueologico');
          break;
        }
        case 'dfq': {
          $resultado = $user->can('crear_analisis_material_litico') || $user->can('ver_analisis_material_litico')
                        || $user->can('crear_ficha_metales') || $user->can('ver_ficha_metales')
                        || $user->can('crear_analisis_materiales') || $user->can('ver_analisis_materiales')
                        || $user->can('crear_analisis_ceramicos') || $user->can('ver_analisis_materiales_ceramicos')
                        || $user->can('crear_analisis_micro_quimico') || $user->can('ver_analisis_micro_quimico')
                        || $user->can('crear_analisis_arqueobiologico') || $user->can('ver_analisis_arqueobiologico')
                        || $user->can('crear_analisis_aguas') || $user->can('ver_analisis_aguas')
                        || $user->can('crear_peritaje_especimenes_fosiles') || $user->can('ver_peritaje_especimenes_fosiles');
          break;
        }
        case 'calificaciones': {
          $resultado = true;
          break;
        }
        case 'cgm': {
          $resultado = true;
          break;
        }
        case 'certificaciones': {
          $resultado = true;
          break;
        }
        case 'catastro': {
          $resultado = true;
          break;
        }
        default:
        break;
      }
      return $resultado;
    });
  }
}
