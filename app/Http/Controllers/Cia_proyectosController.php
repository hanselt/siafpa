<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cia_Proyecto;
use App\Gen_persona;
use Illuminate\Support\Facades\Input;

class Cia_proyectosController extends Controller
{
    //
     public function index()
    {
       // $proyectos = Cia_Proyecto::all();
        $proyectos = \DB::select("select * from cia_proyectos");
        return view('admincalificacion.ciaproyectos.index')
          ->with('proyectos', $proyectos)
          ->with('lcTipo','ccia');
    }
    public function create()
    {
        
    }
    public function show() 
    {
        //
        
    }
    public function ShowCia($id)
    {
        //ShowPma
        $ids=explode(' ', $id);
        $proyecto = \DB::table('cia_proyectos')
                ->where('cia_proyectos.PROY_varHojaTramite','like','%'.$ids[0].'%')
                ->first();
        
        if ($proyecto) {
          # code...
          $persona=Gen_persona::find($proyecto->PERS_varDNI);
          return view('proyectos.cia')->with('Proyecto',$proyecto)->with('Persona',$persona);
        }
        else
          return 'No existe el Proyecto';
    }
    public function destroy($id)
    {	
       
    }
    public function store(Request $request)
    {	
    	//return "ejemplo01";
        $idProyecto = $request->PROY_varHojaTramite;
        $Proyecto = Cia_Proyecto::find($idProyecto);
        $alreadypath=$Proyecto->PROY_varDirArchivo;

        //$ArrayPath=explode('/', $alreadypath);
       // $fileNombre= $ArrayPath[2];        
        //$exists = Storage::disk('cia')->exists($fileNombre);
        $path = 'archivos/cia/';
        $files = $request->file('file');
        $lcPath = '';
        foreach($files as $file){
            $fileName = $idProyecto.'-'.$file->getClientOriginalName();
            $file->move($path, $fileName);
            $lcPath = $path.$fileName;
        }


        if (is_file('/'.$alreadypath)) {
           /* Verifica si ya existe un archivo */
           //Si existe debe eliminar el archivo anterior
                  //Storage::delete('archivos/cia/'.$fileNombre);
                  $fileDel=new file;
                  $fileDel->delete($alreadypath);
                  $Proyecto->PROY_varDirArchivo = $lcPath;
                  $Proyecto->save();

           } 
           else{//caso contrario solo agrega el nuevo archivo
                  $Proyecto->PROY_varDirArchivo = $lcPath;
                  $Proyecto->save();
           }
        
        $proyectos = \DB::select("select * from cia_proyectos");
        return view('admincalificacion.ciaproyectos.index')
          ->with('proyectos', $proyectos)
          ->with('lcTipo','ccia');
    }
    public function edit($id)
    {        
        $proyecto = Cia_Proyecto::find($id);
        return view('admincalificacion.ciaproyectos.edit')->with('proyecto',$proyecto)
        								->with('idProyecto',$id)
                        ->with('lcTipo','ccia');
    }
    public function update(Request $request, $id)
    {
        
    }

    public function proyectos()
    {
        $proyectos = \DB::table('cia_proyectos')
                ->where('cia_proyectos.PROY_varTipo','!=','pea')
                ->where('cia_proyectos.PROY_varTipo','!=','pia')
                ->where('cia_proyectos.PROY_varTipo','!=','pria')
                ->where('cia_proyectos.PROY_varTipo','!=','pra')
                ->get();

        return \Response::json($proyectos);
    }
    public function pias()
    {
        $proyectos = \DB::table('cia_proyectos')
              ->where('cia_proyectos.PROY_varTipo','=','pia')
              ->get();
        return \Response::json($proyectos);
    }
    public function peas()
    {
        $proyectos = \DB::table('cia_proyectos')
              ->where('cia_proyectos.PROY_varTipo','=','pea')
              ->get();

        return \Response::json($proyectos);
    }
    public function prias()
    {
        $proyectos = \DB::table('cia_proyectos')
              ->where('cia_proyectos.PROY_varTipo','=','pra')
              ->get();

        return \Response::json($proyectos);
    }

}
