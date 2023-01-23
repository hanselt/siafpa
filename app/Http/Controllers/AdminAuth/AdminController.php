<?php

namespace App\Http\Controllers\AdminAuth;

use App\Admincalificacion;
use App\Admincatastro;
use App\Admincgm;
use App\Admin;
use App\Admincira;
use App\Gen_coordinacion;
use App\Gen_monumento;
use App\Gen_persona;
use App\Gen_ubigeo;
use App\Http\Requests\Gen_coordinacionRequest;
use App\Http\Requests\PersonaUpdateRequest;
use App\Http\Requests\Gen_personaRequest;
use App\Http\Requests\Gen_monumentoRequest;
use App\Http\Requests\AdminciraRequest;
use App\Http\Requests\AdminciaRequest;
use App\Http\Requests\AdmincgmRequest;
use App\Http\Requests\AdmincatastroRequest;
use App\Http\Requests\AdminAfpaRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /*
     * Metodos para el CRUD de Persona
     */
    public function editPassword($id)
    {
        $admin=Admin::find($id);
        return view('admin.password')->with('admin',$admin);
    }
    public function updatePassword(Request $request,$id)
    {
        if ($request) {
            # code...

            $Admin=Admin::find($id);
            if($request->password1!='')
            {
                $Admin->password=bcrypt($request->password1);
                $Admin->save();
                return redirect('admin/perfil')->with('status','Contraseña cambiada');
            }
            else
            {
                $admin=Admin::find($id);
                return view('admin.password')->with('admin',$admin);
            }
        }
        else
            $admin=Admin::find($id);
                return view('admin.password')->with('admin',$admin);
    }
    public function createPersona()
    {
        $personas = Gen_persona::all();
        return view('admin.gen_persona.create')->with(array(
            'personas' => $personas
        ));
    }

    public function storePersona(Gen_personaRequest $request)
    {
        if ($request) {
            $Dni=$request->PERS_varDNI;
            $Rna=$request->PERS_varRna;
            $Tipo=$request->PERS_varTipo;
            $Cargo=$request->PERS_varCargo;
            $ApPaterno=$request->PERS_varApPaterno;
            $ApMaterno=$request->PERS_varApMaterno;
            $Nombres=$request->PERS_varNombres;
            $Grado=$request->PERS_varGradoAcademico;
            $Descripcion=$request->PERS_varDescription;

            $DirImagen='/archivos/general/personas/imagen1.jpg';
            
            $persona = new Gen_persona();
            $persona->PERS_varDNI=$Dni;
            $persona->PERS_varRna=$Rna;
            $persona->PERS_varTipo=$Tipo;
            $persona->PERS_varCargo=$Cargo;
            $persona->PERS_varApPaterno=$ApPaterno;
            $persona->PERS_varApMaterno=$ApMaterno;
            $persona->PERS_varNombres=$Nombres;
            $persona->PERS_varGradoAcademico=$Grado;
            $persona->PERS_varDescription=$Descripcion;
            $persona->PERS_varDirImagen=$DirImagen;
            $persona->save();

            //$array = json_decode(json_encode($Dni,$Rna,$Tipo,$Cargo,$ApPaterno,$ApMaterno,$Nombres,$Grado,$Descripcion,$DirImagen),TRUE);
            //turn 'sss';
            //n_persona::crea($persona);
            return redirect('admin/ver-personas')->with('status', 'Articulo guardado con exito');
        }
    }

    public function imagenPersona($id)
    {
        $persona = Gen_persona::find($id);
        return view('admin.gen_persona.imagen',compact('persona',$persona));
    }
    public function updateImagen(Request $request,$id)
    {
        $domain=$_SERVER['SERVER_NAME'];
        $dom='http://'.$domain;
        $path = public_path().'/archivos/general/personas/';
        $pathdb='/archivos/general/personas/';
        $files = $request->file('file');
        $Dni = $id;
        $lcPath = '';
                
        foreach($files as $file){
            $fileName = $Dni.'.jpg';
            $file->move($path, $fileName);
            $lcPath = $pathdb.$fileName;
        }
        
        $Persona = Gen_persona::find($Dni);
        $Persona->PERS_varDirImagen = $lcPath;
        $Persona->save();
        //////// ///// ///// ///// /// //        
    }

    public function editPersona($id)
    {
        // mostrar formulario de edicion
        $persona = Gen_persona::find($id);

        // show the edit form and pass the nerd

        return view('admin.gen_persona.edit', compact('persona', $persona));

    }

    public function updatePersona(PersonaUpdateRequest $request, $id)
    {

        $persona = Gen_persona::find($id);
        $persona->PERS_varRna=$request->PERS_varRna;
        $persona->PERS_varTipo=$request->PERS_varTipo;
        $persona->PERS_varCargo=$request->PERS_varCargo;
        $persona->PERS_varApPaterno=$request->PERS_varApPaterno;
        $persona->PERS_varApMaterno=$request->PERS_varApMaterno;
        $persona->PERS_varNombres=$request->PERS_varNombres;
        $persona->PERS_varGradoAcademico=$request->PERS_varGradoAcademico;
        $persona->PERS_varDescription=$request->PERS_varDescription;


        $persona->save();

        return redirect('admin/ver-personas')->with('status', 'informacion actualizacda');
    }

    
    /*
     * metodos crud para la administracion
     * de monumentos
     */

    public function createMonumento()
    {
        $monumentos = Gen_monumento::all();
        return view('admin.gen_monumento.create')->with(array(
            'monumentos' => $monumentos
        ));
    }

    public function storeMonumento(Gen_monumentoRequest $request)
    {


        if ($request) {
            Gen_monumento::create($request->all());
            return redirect('admin/ver-monumentos')->with('status', 'Monumento  guardado con exito');
        }


    }


    


    /*
     * Metodos Adminstradores Ciras
     */
    public function deleteAdminCira($id)
    {
        $admincira = Admincira::find($id);
        $admincira->delete();
        return redirect('admin/admin-ciras')->with('status','Administrador CIRA eliminado');
    }
    public function createAdmincira()
    {
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();
        return view('admin.adminciras.admin_cira_create',compact('personas',$personas));
    }
    public function storeAdmincira(AdminciraRequest $request)
    {
        if ($request) {
            
            $admincira = new Admincira();
            $admincira->name='';
            $admincira->email=$request->email;
            $admincira->password=bcrypt($request->password);
            $admincira->PERS_varDNI=$request->dni;                        
            $admincira->nivel=$request->nivel;
            $admincira->save();

            //$array = json_decode(json_encode($Dni,$Rna,$Tipo,$Cargo,$ApPaterno,$ApMaterno,$Nombres,$Grado,$Descripcion,$DirImagen),TRUE);
            //turn 'sss';
            //n_persona::crea($persona);
            return redirect('admin/admin-ciras')->with('status','Administrador CIRA agregado');
        }
    }
    //Admin AFPA
    public function createAdminafpa()
    {
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();
        return view('admin.adminafpas.admin_afpa_create',compact('personas',$personas));
    }
    public function storeAdminafpa(AdminAfpaRequest $request)
    {
        if ($request) {  

            $adminafpa = new Admin();
            $adminafpa->name='';
            $adminafpa->email=$request->email;
            $adminafpa->password=bcrypt($request->password);
            $adminafpa->PERS_varDNI=$request->dni;                        
            $adminafpa->nivel=$request->nivel;
            $adminafpa->save();

            return redirect('admin/admin-afpa')->with('status','Administrador AFPA agregado');
        }
    }
    public function adminAfpaList()
    {
        $adminafpas = DB::table('admins')
                      ->join('gen_personas','admins.PERS_varDNI','=','gen_personas.PERS_varDNI')
                      ->select('admins.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')
                      ->get();
        return view('admin.adminafpas.admin_afpa_list', compact('adminafpas', $adminafpas));
    }
    public function editAdminAfpa($id)
    {
        $ida=Auth::User()->id;
        if ($ida!=$id) {
            # code...
            $admin = Admin::find($id);
            $personas = Gen_persona::all();
            return view('admin.adminafpas.admin_afpa_edit', compact('admin', $admin))->with('personas',$personas);
        }
        else
        {
            $msj='No puede modificar el usuario logueado';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }            
    }

    public function updateAdminAfpa(Request $request,$id)
    {
        $ida=Auth::User()->id;
        if ($ida!=$id) {
            # code...
            $admin = Admin::find($id);
            $email=Admin::findEmail($request->email);

            if($email){
            if($admin->email==$email->email)
                $email=null;}
            if ($email) {
                # code...
                $msj='El correo :'.$request->email.' ya pertenece a otro usuario';
                \Session::flash('msg', $msj);
                return \Redirect::back();
            }
            else{
                $admin->email=$request->email;
                $admin->nivel=$request->nivel;
                $admin->PERS_varDNI=$request->PERS_varDNI;
                if ($request->email!=$admin->email) {
                    # code...
                    $admin->bcrypt($request->PERS_varDNI);
                }
                $admin->save();
            }
            return redirect()->action('AdminAuth\AdminController@adminAfpaList');
        }
        else
        {
            $msj='No puede modificar el usuario logueado';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }
        
    }
    public function deleteAdminAfpa($id)
    {
        $ida=Auth::User()->id;
        if ($ida!=$id) {
            # code...
            $admin = Admin::find($id);
            $admin->delete();
            return redirect('admin/admin-afpa')->with('status','Administrador AFPA eliminado');
        }
        else
        {
            $msj='No puede eliminar el usuario logueado';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }

        
    }

//Fin crud AFPA
    public function adminCirasList()
    {
        $adminciras = DB::table('adminciras')
                      ->join('gen_personas','adminciras.PERS_varDNI','=','gen_personas.PERS_varDNI')
                      ->select('adminciras.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres','gen_personas.PERS_varCargo')
                      ->get();
        return view('admin.adminciras.admin_cira_list', compact('adminciras', $adminciras));
    }

    public function editAdminCira($id)
    {

        $admincira = Admincira::find($id);
        $personas = Gen_persona::all();
        return view('admin.adminciras.admin_cira_edit', compact('admincira', $admincira))->with('personas',$personas);

        //dd($admincira->email);
    }

    public function updateAdminCira(Request $request,$id)
    {
        $admincira = Admincira::find($id);
        $email=Admincira::findEmail($request->email);
        if($email){
        if($admincira->email==$email->email)
            $email=null;}
        if ($email) {
            # code...
            $msj='El correo :'.$request->email.' ya pertenece a otro usuario';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }
        else{

            
            $admincira->email=$request->email;
            $admincira->nivel=$request->nivel;
            if ($request->email!=$admincira->email) {
                    # code...
                    $admin->bcrypt($request->PERS_varDNI);
            }
            $admincira->PERS_varDNI=$request->PERS_varDNI;
            $admincira->save();
        }
        return redirect()->action('AdminAuth\AdminController@adminCirasList');
    }

    /*
     * Metodos Adminstradores CGM
     */
    public function createAdmincgm()
    {
        $coordinaciones=DB::table('gen_coordinaciones')
                    ->join('gen_personas','gen_coordinaciones.PERS_varDNI','=','gen_personas.PERS_varDNI')
                    ->select('gen_coordinaciones.PERS_varDNI','gen_coordinaciones.COOR_varNombre','gen_personas.PERS_varNombres','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno')
                    ->orderBy('gen_coordinaciones.COOR_varNombre')
                    ->get();
                   

        return view('admin.admincgms.admin_cgm_create')->with('coordinaciones',$coordinaciones);
    }
    public function storeAdmincgm(AdmincgmRequest $request)
    {
        if ($request) {
                       
            $admincgm = new Admincgm();
            $admincgm->name='';
            $admincgm->PERS_varDNI=$request->dni;
            $admincgm->email=$request->email;
            $admincgm->nivel=$request->nivel;
            $admincgm->password=bcrypt($request->password);
            $admincgm->estado=true;
            $admincgm->save();

            //$array = json_decode(json_encode($Dni,$Rna,$Tipo,$Cargo,$ApPaterno,$ApMaterno,$Nombres,$Grado,$Descripcion,$DirImagen),TRUE);
            //turn 'sss';
            //n_persona::crea($persona);
            return redirect('admin/admin-cgms')->with('status','Administrador CGM agregado');
        }
    }
    public function adminCgmsList()
    {
        $admincgms = DB::table('admincgms')
                    ->join('gen_personas','admincgms.PERS_varDNI','=','gen_personas.PERS_varDNI')
                    ->select('admincgms.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')
                    ->get();
        return view('admin.admincgms.admin_cgm_list', compact('admincgms', $admincgms));
    }

    public function persona()
    {
        $pers = Input::get('pers');
        $persona = Gen_persona::find($pers);
        $Nombres=$persona->PERS_varApPaterno.' '.$persona->PERS_varApMaterno.', '.$persona->PERS_varNombres;
        return \Response::json($Nombres);
    }

    public function editAdminCgm($id)
    {

        $admincgm = Admincgm::find($id);
        $personas = Gen_persona::all();
        return view('admin.admincgms.admin_cgm_edit', compact('admincgm', $admincgm))->with('personas',$personas);
    }

    public function updateAdminCgm(Request $request,$id)
    {
        $admincgm = Admincgm::find($id);
        $email=Admincgm::findEmail($request->email);

        if($email){
        if($admincgm->email==$email->email)
            $email=null;}
        if ($email) {
            # code...
            $msj='El correo :'.$request->email.' ya pertenece a otro usuario';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }
        else{
            $admincgm->email=$request->email;
            $admincgm->estado=$request->estado;
            $admincgm->nivel=$request->nivel;
            $admincgm->PERS_varDNI=$request->PERS_varDNI;
            $admincgm->save();
        }
        return redirect()->action('AdminAuth\AdminController@adminCgmsList');
    }
    public function deleteAdminCgm($id)
    {
        $admincgm = Admincgm::find($id);
        $admincgm->delete();
        return redirect('admin/admin-cgms')->with('status','Administrador Cgm eliminado');
    }

    /*
  * Metodos Adminstradores Calificaciones
  */
    public function createAdmincalificacion()
    {
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();
        return view('admin.admincalificaciones.admin_calificacion_create',compact('personas',$personas));
    }
    public function storeAdmincalificacion(AdminciaRequest $request)
    {
        if ($request) {        
            $admincgm = new Admincalificacion();
            $admincgm->name='';
            $admincgm->email=$request->email;
            $admincgm->password=bcrypt($request->password);
            $admincgm->PERS_varDNI=$request->dni;                        
            $admincgm->nivel=1;
            $admincgm->save();

            //$array = json_decode(json_encode($Dni,$Rna,$Tipo,$Cargo,$ApPaterno,$ApMaterno,$Nombres,$Grado,$Descripcion,$DirImagen),TRUE);
            //turn 'sss';
            //n_persona::crea($persona);
            return redirect('admin/admin-calificaciones')->with('status','Administrador CIA agregado');
        }
    }
    public function adminCalificacionesList()
    {
        $admincalificaciones = DB::table('admincalificacions')
                               ->join('gen_personas','admincalificacions.PERS_varDNI','=','gen_personas.PERS_varDNI')
                               ->select('admincalificacions.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->get();
        return view('admin.admincalificaciones.admin_calificaciones_list', compact('admincalificaciones', $admincalificaciones));
    }

    public function editAdminCalificacion($id)
    {

        $admincalificacion = Admincalificacion::find($id);
        $personas=Gen_persona::all();
        return view('admin.admincalificaciones.admin_calificacion_edit', compact('admincalificacion', $admincalificacion))->with('personas',$personas);
    }

    public function updateAdminCalificacion(Request $request,$id)
    {
        $admincalificacion = Admincalificacion::find($id);
        $email=Admincalificacion::findEmail($request->email);
        if($email){
        if($admincalificacion->email==$email->email)
            $email=null;}
        if ($email) {
            # code...
            $msj='El correo :'.$request->email.' ya pertenece a otro usuario';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }
        else{
            $admincalificacion->email=$request->email;
            $admincalificacion->PERS_varDNI=$request->PERS_varDNI;
            $admincalificacion->save();
        }
        return redirect()->action('AdminAuth\AdminController@adminCalificacionesList');
    }
    public function deleteAdminCalificacion($id)
    {
        $admincalificacion = Admincalificacion::find($id);
        $admincalificacion->delete();
        return redirect('admin/admin-ciras')->with('status','Administrador CIA eliminado');
    }

    /*
    * Metodos Adminstradores Catastros
    */
    public function createAdmincatastro()
    {
        $personas=DB::table('gen_personas')->select('gen_personas.PERS_varDNI','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')->orderBy('gen_personas.PERS_varApPaterno')->get();
        return view('admin.admincatastros.admin_catastro_create',compact('personas',$personas));
    }
    public function storeAdmincatastro(AdmincatastroRequest $request)
    {
        if ($request) {  
            $admincatastro = new AdminCatastro();
            $admincatastro->name='';
            $admincatastro->email=$request->email;
            $admincatastro->password=bcrypt($request->password);
            $admincatastro->PERS_varDNI=$request->dni;                        
            $admincatastro->estado=true;
            $admincatastro->save();

            //$array = json_decode(json_encode($Dni,$Rna,$Tipo,$Cargo,$ApPaterno,$ApMaterno,$Nombres,$Grado,$Descripcion,$DirImagen),TRUE);
            //turn 'sss';
            //n_persona::crea($persona);
            return redirect('admin/admin-catastros')->with('status','Administrador CIA agregado');
        }
    }

    public function adminCatastrosList()
    {
        $admincatastros = DB::table('admincatastros')
                          ->join('gen_personas','admincatastros.PERS_varDNI','=','gen_personas.PERS_varDNI')
                          ->select('admincatastros.*','gen_personas.PERS_varApPaterno','gen_personas.PERS_varApMaterno','gen_personas.PERS_varNombres')   
                          ->get();
        return view('admin.admincatastros.admin_catastros_list', compact('admincatastros', $admincatastros));
    }

    public function editAdminCatastro($id)
    {

        $personas = Gen_persona::all();
        $admincatastro = AdminCatastro::find($id);
        return view('admin.admincatastros.admin_catastro_edit', compact('admincatastro', $admincatastro))->with('personas',$personas);;
    }

    public function updateAdminCatastro(Request $request,$id)
    {
        $admincatastro = Admincatastro::find($id);
        $email=Admincatastro::findEmail($request->email);
        if($email){
        if($admincatastro->email==$email->email)
            $email=null;}
        if ($email) {
            # code...
            $msj='El correo :'.$request->email.' ya pertenece a otro usuario';
            \Session::flash('msg', $msj);
            return \Redirect::back();
        }
        else{

            
            $admincatastro->email=$request->email;
            $admincatastro->estado=$request->estado;
            $admincatastro->PERS_varDNI=$request->PERS_varDNI;
            $admincatastro->save();
        }
        return redirect()->action('AdminAuth\AdminController@adminCatastrosList');
    }//deleteAdminCatastro
    public function deleteAdminCatastro($id)
    {
        $admincatastro = Admincatastro::find($id);
        $admincatastro->delete();
        return redirect('admin/admin-catastros')->with('status','Administrador Castastro eliminado');
    }

}
