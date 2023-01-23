<?php

namespace App\Http\Controllers\AdminciraAuth;

use Illuminate\Http\Request;
use App\Admincira;
use App\Cir_cira;
use App\Http\Requests\Gen_coordinacionRequest;
use App\Http\Requests\CoordinacionUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminciraController extends Controller
{
    //
    public function editPassword($id)
    {
        $admin=Admincira::find($id);
        return view('admincira.password')->with('admin',$admin);
    }
    public function updatePassword(Request $request,$id)
    {
        if ($request) {
            # code...

            $Admincira=Admincira::find($id);
            if($request->password1!='')
            {
                $Admincira->password=bcrypt($request->password1);
                $Admincira->save();
                return redirect('admincira/perfil')->with('status','Contraseña cambiada');
            }
            else
            {
                $admin=Admincira::find($id);
                return view('admincira.password')->with('admin',$admin);
            }
        }
        else
            $admin=Admincira::find($id);
                return view('admincira.password')->with('admin',$admin);
    }
    public function createCira()
    {
        
    }
    public function storeCira(Request $request)
    {
        if ($request) {
            # code...
            dd($request);
            $Cira= new Cir_cira;
        }
    }
}
