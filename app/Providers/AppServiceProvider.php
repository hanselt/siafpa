<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Se define la longitud por defecto del string para las migraciones.
    Schema::defaultStringLength(191);

    // Se define la equivalencia para las relaciones polimórficas.
    Relation::morphMap([
      /* Proyectos */
      'cia_proyectos' => 'App\CiaProyectos',
      'cir_pmas' => 'App\CirPmas',
      'requisas' => 'App\Requisas',
      /* Módulos con varias fotografías */
      'catalogacion' => 'App\GmcpcamCatalogaciones',
      'intervencion' => 'App\GmcpcamIntervenciones',
      'conservacion' => 'App\GicpbamConservaciones',
      'analisis_metales' => 'App\DfqAnalisisMetales',
      'analisis_materiales' => 'App\DfqAnalisisMateriales',
      'analisis_aguas' => 'App\DfqAnalisisAguas',
    ]);

    // Definir una directiva Blade personalizada para mostrar el inventario óseo.
    Blade::directive('gafclave', function ($expression) {
      return "<?php echo substr($expression, 0, 1); ?>";
    });
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    /**
     * Registrar helpers personalizados.
     */
    require_once app_path('Http/helpers.php');
  }
}
