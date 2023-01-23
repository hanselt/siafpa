<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia_Proyecto;
use App\Gen_persona;
use App\Cir_pma;
use App\Cir_cira;
use Illuminate\Support\Facades\Auth;
class ImportarExcelController extends Controller
{
    	
	
	
	function Convertir()
	{
		$utm1 = new \UTMRef(746361.608301,8608182.1497, "L", 1);
		echo "UTM Reference: " . $utm1->toString() . "<br />";
		$ll3 = $utm1->toLatLng();
		echo "Converted to Lat/Long: " . $ll3->toString();
		echo $ll3->lat;
		echo $ll3->lng;
		dd($ll3);

		
	}
	

	public function cargarccia()
	{
		$lcTipo='ccia';
	    return view('cargaexcel.formulario')->with('lcTipo',$lcTipo);
	}
	public function cargarpma()
	{
		$lcTipo='pma';
		$nivel=Auth::User()->nivel;
		if ($nivel==2) {
			# code...
	    	return view('cargaexcel.formulario')->with('lcTipo',$lcTipo);
	    }
	    else
		{
			return view('admincira.acceso');
		}
	}
	public function cargarcira()
	{
		$nivel=Auth::User()->nivel;
		$lcTipo='cira';
		if ($nivel==2) {
			# code... 
			return view('cargaexcel.formulario')->with('lcTipo',$lcTipo);
		}
		else
		{
			return view('admincira.acceso');
		}
	    
	}
    public function cargarcciaPOST(Request $request)
 	{
        $path = public_path().'/uploads/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, 'cargar.xls');
            //echo $fileName;
        }        
 	}    
 	 public function cargarpmaPOST(Request $request)
 	{
        $path = public_path().'/uploads/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, 'cargar.xls');
            //echo $fileName;
        }
        
 	}   
 	 public function cargarciraPOST(Request $request)
 	{
        $path = public_path().'/uploads/';
        $files = $request->file('file');
        foreach($files as $file){
            $fileName = $file->getClientOriginalName();
            $file->move($path, 'cargar.xls');
           // echo $fileName;
        }
        // leer excel con libreria de excel
       //cargaexcel();
 	}   
    public function importarCiaProyectos()
    {
    	//echo 'archivo subido';
		\Excel::load('uploads/cargar.xls', function($reader) {
			//echo 'ejemplo';
			$results = $reader->all();
			//dd($results);
			$i=1;
			foreach ($results as $row) {
				// verificar que 
				
                //echo 'PROCESANDO <br>';    
                //echo $i .'.';  

			    if ($row->hoja_de_ruta==null)
				{
					break;
				}
			    // buscar RNA en la tabla de Personas	
			    $dniDirector = '1';			
				$count = Gen_persona::where('PERS_varRna', $row->rna)->count();
				if ($count>1){
					$lcPersona= Gen_persona::where('PERS_varRna', $row->rna)->first();
					$dniDirector=$lcPersona->PERS_varDNI;
				}

				$lcExisteProyecto = Cia_Proyecto::where('PROY_varHojaTramite',$row->hoja_de_ruta)->count();         
				// CONVERTIR COORDENADAS ANTES DE ALMACENAR EN LA BD    
                $zona=(int)substr($row->zona_geograf,0,2);							
				$utm1 = new \UTMRef($row->coord_utm_x,$row->coord_utm_y, "L", $zona);				
				$ll3 = $utm1->toLatLng();
                				
				if ($lcExisteProyecto>0){
					$proyecto = Cia_Proyecto::find($row->hoja_de_ruta);

					$proyecto->UBIG_varDepartamento = $row->departamento;
					$proyecto->UBIG_varProvincia = $row->provincia;
					$proyecto->UBIG_varDistrito = $row->distrito;
					$proyecto->PERS_varDNI = $dniDirector;
					$proyecto->PROY_datFechaIngreso = $row->fecha_ingreso;
					$proyecto->PROY_varNombre= $row->nombre_del_proyecto;
					$proyecto->PROY_varTipo = $row->tipo;
					$proyecto->PROY_varResumenProyecto= $row->asunto_resumen_proyecto;
					$proyecto->PROY_varRubro = $row->rubro;
					$proyecto->PROY_varEmpresa = $row->empresa;
					$proyecto->PROY_douCoordenadaLatitud =$ll3->lat; //$row->coord_utm_y;//$lcLatLon['lat'];
					$proyecto->PROY_douCoordenadaLongitud =$ll3->lng; //$row->coord_utm_x;
					//$proyecto->PROY_varDirArchivo = 'ejemplo';
					$proyecto->PROY_varResolucionAprobacion ='--';
					$proyecto->PROY_datFechaRDAprobacion =$row->fecha;
					$proyecto->PROY_varPlazoEjecucion=$row->plazo_de_ejecucion;
					
					$proyecto->save();
					
				}else{
					$proyecto = new Cia_Proyecto();
					// VERIFICAR SI YA EXISTE EN LA BASE DE DATOS									
					$proyecto->PROY_varHojaTramite = $row->hoja_de_ruta;
					$proyecto->UBIG_varDepartamento = $row->departamento;
					$proyecto->UBIG_varProvincia = $row->provincia;
					$proyecto->UBIG_varDistrito = $row->distrito;
					$proyecto->PERS_varDNI = $dniDirector;
					$proyecto->PROY_datFechaIngreso = $row->fecha_ingreso;
					$proyecto->PROY_varNombre= $row->nombre_del_proyecto;
					$proyecto->PROY_varTipo = $row->tipo;
					$proyecto->PROY_varResumenProyecto= $row->asunto_resumen_proyecto;
					$proyecto->PROY_varRubro = $row->rubro;
					$proyecto->PROY_varEmpresa = $row->empresa; 
					$proyecto->PROY_douCoordenadaLatitud = $ll3->lat;
					$proyecto->PROY_douCoordenadaLongitud = $ll3->lng;
					$proyecto->PROY_varDirArchivo = '';
					$proyecto->PROY_varResolucionAprobacion ='--';
					$proyecto->PROY_datFechaRDAprobacion =$row->fecha;
					$proyecto->PROY_varPlazoEjecucion=$row->plazo_de_ejecucion;
					
					$proyecto->save();
			    	//echo $row->n0.'<br>';			    
				}

			    $i++;
			}
			//echo $lcExisteProyecto.'<br>';

		});
		return view('cargaexcel.formulario')
			->with('lcProceso','CCIA')
			->with('lcTipo','ccia');
    }
    public function importarCIRA(){
    	//echo 'archivo subido';
    	try{
			\Excel::load('uploads/cargar.xls', function($reader) {
				//echo 'ejemplo';
				$results = $reader->all();
				//dd($results);
				$i=1;
				// dd($results);
				foreach ($results as $row) {

				    if ($row->no_de_documento_n0_de_ht==null)
					{
						break;
					}
				    // buscar RNA en la tabla de Personas	
				    $dniDirector = '0';			
					$count = Gen_persona::where('PERS_varRna', $row->rna_arqueologo_asignado)->count();
					if ($count>1){
						$lcPersona= Gen_Persona::where('PERS_varRna', $row->rna_arqueologo_asignado)->first();
						$dniDirector=$lcPersona->PERS_varDNI;
					}


					$lcExisteProyecto = Cir_cira::where('CIRA_varHojaTramite',$row->no_de_documento_n0_de_ht)->count();

					// convertir coordenda antes de guardarlo en BD
					$zona=(int)substr($row->zona_geograf,0,2);							
					$utm1 = new \UTMRef($row->punto_referencial_utm_este,$row->punto_referencial_utm_norte, "L", substr($row->punto_referencial_utm_zona,0,2));				
					$ll3 = $utm1->toLatLng();

				//	echo $row->punto_referencial_utm_este.'--'.$row->punto_referencial_utm_norte.'--'.substr($row->punto_referencial_utm_zona,0,2).'-->'.$ll3->toString().'<br>';
				//	$lcLatLon = $this->LatLonPointUTMtoLL($row->punto_referencial_utm_norte,$row->punto_referencial_utm_este,substr($row->punto_referencia,0,2));
					

					if ($lcExisteProyecto>0){
						$proyecto = Cir_cira::find($row->no_de_documento_n0_de_ht);

						$proyecto->CIRA_datFechaRecepcionTD 	= $row->fecha_de_recepcion_en_tramite_documentario;
						$proyecto->CIRA_datFechaRecepcionCIRA 	= $row->fecha_de_recepcion_coordinacion_de_certificaciones;
						$proyecto->CIRA_varNombreProyecto 		= $row->nombre_del_proyecto;
						$proyecto->CIRA_varAdministradorEmpresa = $row->nombre_del_administrador_y_empresa_solicitante;
						$proyecto->UBIG_varProvincia			= $row->provincia;
						$proyecto->UBIG_varDistrito				= $row->distrito;
						$proyecto->UBIG_varLocalidad			= $row->localidad;
						$proyecto->CIRA_varExtensionSuperficie	= $row->extension_o_superficie;
						$proyecto->CIRA_varTipoObra				= $row->tipo_de_obra;
						$proyecto->CIRA_varResultado			= $row->resultado;
						$proyecto->CIRA_varMotivoDesestimacion	= $row->motivo_de_desestimacion;
						$proyecto->CIRA_varNroCira				= $row->n0_de_cira;
						$proyecto->CIRA_datFechaExpedicionCira	= $row->fecha_de_expedicion_de_cira;
						$proyecto->CIRA_datFechaNotificacion	= $row->fecha_de_notificacion;
						$proyecto->PMA_douCoordenadaX			= $ll3->lat;
						$proyecto->PMA_douCoordenadaY			= $ll3->lng;
						
						$proyecto->save();
						
					}else{
						$proyecto = new Cir_cira();
						// VERIFICAR SI YA EXISTE EN LA BASE DE DATOS									
						$proyecto->CIRA_varHojaTramite			= $row->no_de_documento_n0_de_ht;
						$proyecto->CIRA_datFechaRecepcionTD 	= $row->fecha_de_recepcion_en_tramite_documentario;
						$proyecto->CIRA_datFechaRecepcionCIRA 	= $row->fecha_de_recepcion_coordinacion_de_certificaciones;
						$proyecto->CIRA_varNombreProyecto 		= $row->nombre_del_proyecto;
						$proyecto->CIRA_varAdministradorEmpresa = $row->nombre_del_administrador_y_empresa_solicitante;
						$proyecto->UBIG_varProvincia			= $row->provincia;
						$proyecto->UBIG_varDistrito				= $row->distrito;
						$proyecto->UBIG_varLocalidad			= $row->localidad;
						$proyecto->CIRA_varExtensionSuperficie	= $row->extension_o_superficie;
						$proyecto->CIRA_varTipoObra				= $row->tipo_de_obra;
						$proyecto->CIRA_varResultado			= $row->resultado;
						$proyecto->CIRA_varMotivoDesestimacion	= $row->motivo_de_desestimacion;
						$proyecto->CIRA_varNroCira				= $row->n0_de_cira;
						$proyecto->CIRA_datFechaExpedicionCira	= $row->fecha_de_expedicion_de_cira;
						$proyecto->CIRA_datFechaNotificacion	= $row->fecha_de_notificacion;
						$proyecto->PMA_douCoordenadaX			= $ll3->lat;
						$proyecto->PMA_douCoordenadaY			= $ll3->lng;
						
						$proyecto->save();
				    	//echo $row->n0.'<br>';			    
					}



				    $i++;
				}
				//echo $lcExisteProyecto.'<br>';

			});
		}catch(\Exception $e){
   			echo ($e->getMessage());
		}
		return view('cargaexcel.formulario')
			->with('lcProceso','CIRA')
			->with('lcTipo','cira');
    }
    public function importarPMA(){
    	//echo 'archivo subido';
		\Excel::load('uploads/cargar.xls', function($reader) {
			// echo '1 <br>';
			$results = $reader->all();
			//echo '2 <br>';
			//dd($results);
			$i=1;
			// dd($results);
			foreach ($results as $row) {
				// echo '3 <br>';
				//echo $row->hoja_de_ruta.'<BR>';
				// dd($row);       
			    if ($row->hoja_de_ruta_proyecto==null)
				{
					break;
				}
			    // buscar RNA en la tabla de Personas	
			    $dniDirector = '1';			
				$count = Gen_Persona::where('PERS_varRna', $row->rna_de_dir_proy)->count();
				if ($count>1){
					$lcPersona= Gen_Persona::where('PERS_varRna', $row->rna_de_dir_proy)->first();
					$dniDirector=$lcPersona->PERS_varDNI;
				}


				$lcExisteProyecto = Cir_pma::where('PMA_varHojaTramite',$row->hoja_de_ruta_proyecto)->count();
				//$lcLatLon = $this->LatLonPointUTMtoLL($row->punto_referencial_utm_norte,$row->punto_referencial_utm_este,substr($row->punto_referencial_utm_zona,0,2));


				// convertir coordenda antes de guardarlo en BD
					$zona=(int)substr($row->zona_geograf,0,2);							
					$utm1 = new \UTMRef($row->punto_referencial_utm_este,$row->punto_referencial_utm_norte, "L", substr($row->punto_referencial_utm_zona,0,2));				
					$ll3 = $utm1->toLatLng();

				if ($lcExisteProyecto>0){
					$proyecto = Cir_pma::find($row->hoja_de_ruta_proyecto);

					$proyecto->UBIG_varDepartamento = $row->departamento;
					$proyecto->UBIG_varProvincia = $row->provincia;
					$proyecto->UBIG_varDistrito = $row->distrito;
					$proyecto->PERS_varDNI = $dniDirector;
					$proyecto->PMA_datFechaRecepcionTD = $row->fecha_recepcion_en_tramite_documentario;
					$proyecto->PMA_datFechaRecepcionCCIRA = $row->fecha_de_recepcion_coord_de_certificacion;
					$proyecto->PMA_varNombreProyecto= $row->nombre_del_proyecto;
					$proyecto->PMA_varNombreAdminEmpresaSolicitante = $row->nombre_de_administradoryo_empresa_solicitante;
					$proyecto->PMA_varRubro = $row->rubro_tipo_de_obra;											
					$proyecto->PMA_varCentroPoblado = $row->centro_poblado;
					$proyecto->PMA_varDepartamento = $row->departamento;
					$proyecto->PMA_varProvincia = $row->provincia;
					$proyecto->PMA_varDistrito = $row->distrito;
					$proyecto->PMA_douCoordenadaX= $ll3->lat;
					$proyecto->PMA_douCoordenadaY = $ll3->lng;
					$proyecto->PMA_douExtensionSuperficie = $row->extension_o_superficie;
					$proyecto->PMA_varArchivoKML = '';
					$proyecto->PMA_varNFEmitidoCCaAFPA = $row->numero_y_fecha_del_informe_emitido_por_la_cc_al_afpa;
					$proyecto->PMA_varNRDAprobacionPMA = $row->n0_rd_aprobacion_pma;
					$proyecto->PMA_datFechaAprobRDPMA =$row->fecha_de_rd_aprobacion_pma;
					$proyecto->PMA_varPeriodo =$row->periodo;
					$proyecto->PMA_varDocPMA='-';
					
					$proyecto->save();
					
				}else{
					//CIRA PMA 
					$proyecto = new Cir_pma();
					// VERIFICAR SI YA EXISTE EN LA BASE DE DATOS		
					$proyecto->PMA_varHojaTramite = $row->hoja_de_ruta_proyecto;							
					$proyecto->UBIG_varDepartamento = $row->departamento;
					$proyecto->UBIG_varProvincia = $row->provincia;
					$proyecto->UBIG_varDistrito = $row->distrito;
					$proyecto->PERS_varDNI = $dniDirector;
					$proyecto->PMA_datFechaRecepcionTD = $row->fecha_recepcion_en_tramite_documentario;
					$proyecto->PMA_datFechaRecepcionCCIRA = $row->fecha_de_recepcion_coord_de_certificacion;
					$proyecto->PMA_varNombreProyecto= $row->nombre_del_proyecto;
					$proyecto->PMA_varNombreAdminEmpresaSolicitante = $row->nombre_de_administradoryo_empresa_solicitante;
					$proyecto->PMA_varRubro = $row->rubro_tipo_de_obra;											
					$proyecto->PMA_varCentroPoblado = $row->centro_poblado;
					$proyecto->PMA_varDepartamento = $row->departamento;
					$proyecto->PMA_varProvincia = $row->provincia;
					$proyecto->PMA_varDistrito = $row->distrito;
					$proyecto->PMA_douCoordenadaX= $ll3->lat;
					$proyecto->PMA_douCoordenadaY = $ll3->lng;
					$proyecto->PMA_douExtensionSuperficie = $row->extension_o_superficie;
					$proyecto->PMA_varArchivoKML = '';
					$proyecto->PMA_varNFEmitidoCCaAFPA = $row->numero_y_fecha_del_informe_emitido_por_la_cc_al_afpa;
					$proyecto->PMA_varNRDAprobacionPMA = $row->n0_rd_aprobacion_pma;
					$proyecto->PMA_datFechaAprobRDPMA =$row->fecha_de_rd_aprobacion_pma;
					$proyecto->PMA_varPeriodo =$row->periodo;
					$proyecto->PMA_varDocPMA='-';
					
					$proyecto->save();	

				}

			    $i++;
			}
			//echo $lcExisteProyecto.'<br>';A

		});
		return view('cargaexcel.formulario')
			->with('lcProceso','PMA')
			->with('lcTipo','pma');
    }
}
