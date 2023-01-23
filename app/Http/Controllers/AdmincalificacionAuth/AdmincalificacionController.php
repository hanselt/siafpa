<?php

namespace App\Http\Controllers\AdmincalificacionAuth;

use Illuminate\Http\Request;
use App\Admincalificacion;
use App\Http\Requests\Gen_coordinacionRequest;
use App\Http\Requests\CoordinacionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdmincalificacionController extends Controller
{
    //
    public function editPassword($id)
    {
        $admin=Admincalificacion::find($id);
        return view('admincalificacion.password')->with('admin',$admin);
    }
    public function updatePassword(Request $request,$id)
    {
        if ($request) {
            # code...

            $Admincalificacion=Admincalificacion::find($id);
            if($request->password1!='')
            {
                $Admincalificacion->password=bcrypt($request->password1);
                $Admincalificacion->save();
                return redirect('admincalificacion/perfil')->with('status','Contraseña cambiada');
            }
            else
            {
                $admin=Admincalificacion::find($id);
                return view('admincalificacion.password')->with('admin',$admin);
            }
        }
        else
            $admin=Admincalificacion::find($id);
                return view('admincalificacion.password')->with('admin',$admin);
    }
}
