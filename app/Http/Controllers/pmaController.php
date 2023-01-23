<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cir_pma;
use App\Gen_persona;

class pmaController extends Controller
{
    //
     public function index()
    {
       // $proyectos = Cia_Proyecto::all();
        $pmas = \DB::select("select * from cir_pmas");
        return view('pmas.index')->with('pmas', $pmas);
    }
    public function create()
    {
        
    }
    public function show()
    {
        //
        
    }
    public function destroy($id)
    {	
       
    }
    public function ShowPma($id)
    {
        //ShowPma
        $ids=explode(' ', $id);
        $proyecto = \DB::table('cir_pmas')
                ->where('cir_pmas.PMA_varHojaTramite','like','%'.$ids[0].'%')
                ->first();
        
        if ($proyecto) {
          # code...
          $persona=Gen_persona::find($proyecto->PERS_varDNI);
          return view('proyectos.pma')->with('Proyecto',$proyecto)->with('Persona',$persona);
        }
        else
          return 'No existe el Pma';
        
    }
    public function store(Request $request)
    {	
    	//return "ejemplo01";
        $idPma = $request->PMA_varHojaTramite;
        //dd($idPma);
        $Pma = Cir_pma::find($idPma);
        $alreadypath=$Pma->PMA_varDocPMA;

        //$ArrayPath=explode('/', $alreadypath);
        //$fileNombre= $ArrayPath[2];        
        //$exists = Storage::disk('cia')->exists($fileNombre);
        $path = 'archivos/cira/';
        $files = $request->file('file');
        $lcPath = '';
        foreach($files as $file){
            $fileName = $idPma.'-'.$file->getClientOriginalName();
            $file->move($path, $fileName);
            $lcPath = $path.$fileName;
        }


        if (is_file('/'.$alreadypath)) {
           /* Verifica si ya existe un archivo */
           //Si existe debe eliminar el archivo anterior
                  //Storage::delete('archivos/cia/'.$fileNombre);
                  $fileDel=new file;
                  $fileDel->delete($alreadypath);
                  $Pma->PMA_varDocPMA = $lcPath;
                  $Pma->save();

           } 
           else{//caso contrario solo agrega el nuevo archivo
                  $Pma->PMA_varDocPMA = $lcPath;
                  $Pma->save();
           }
        
        $pmas = \DB::select("select * from cir_pmas");
        return view('pmas.index')->with('pmas', $pmas);
    }
    public function edit($id)
    {        
        $pma = Cir_pma::find($id);
        return view('pmas.edit')->with('pma',$pma)
        								->with('idPma',$id);
    }
    public function update(Request $request, $id)
    {
        
    }
    public function pmas()
    {
        $pmas = \DB::table('cir_pmas')->get();

        return \Response::json($pmas);
    }
}
