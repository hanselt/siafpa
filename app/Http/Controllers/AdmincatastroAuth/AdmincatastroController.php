<?php

namespace App\Http\Controllers\AdmincatastroAuth;

use Illuminate\Http\Request;
use App\Gen_coordinacion;
use App\Gen_ubigeo;
use App\Gen_persona;
use App\Admincgm;
use App\Admincatastro;
use App\Http\Requests\Gen_coordinacionRequest;
use App\Http\Requests\CoordinacionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdmincatastroController extends Controller
{
    //
    public function editPassword($id)
    {
        $admin=Admincatastro::find($id);
        return view('admincatastro.password')->with('admin',$admin);
    }
    public function updatePassword(Request $request,$id)
    {
        if ($request) {
            # code...

            $Admincatastro=Admincatastro::find($id);
            if($request->password1!='')
            {
                $Admincatastro->password=bcrypt($request->password1);
                $Admincatastro->save();
                return redirect('admincatastro/perfil')->with('status','Contraseña cambiada');
            }
            else
            {
                $admin=Admincatastro::find($id);
                return view('admincatastro.password')->with('admin',$admin);
            }
        }
        else
            $admin=Admincatastro::find($id);
                return view('admincatastro.password')->with('admin',$admin);
    }
}
