<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionController extends Controller
{
    
    public function index($user_id)
    {
        // TODO: paginación
        return Permission::where('user_id', $user_id)->orderBy('id', 'desc')->get();
    }
    
    public function generate(Request $request)
    {

        $token = Hash::make($request->user_id.'-'.$request->credit);

        $user = User::where('id', $request->user_id)->first();
        $permiso = DB::select('select * from permissions where estado = 1 and user_id = '.$request->user_id.'');

        if($user->plan == 0 && count($permiso) > 0){
            return [
                'message' => 'Aún tienes tokens activos',
                'status' => false,
                'postdata' => 'Para generar mas de 1 token a la vez cambie de plan'
            ];
        }else if($user->plan == 1 && count($permiso) > 2){
            return [
                'message' => 'Aún tienes tokens activos',
                'status' => false,
                'postdata' => 'Para generar mas de 1 token a la vez cambie de plan'
            ];
        }else if($user->plan == 2 && count($permiso) > 4){
            return [
                'message' => 'Aún tienes tokens activos',
                'status' => false,
                'postdata' => 'Para generar mas de 1 token a la vez cambie de plan'
            ];
        }else if($user->plan == 3 && count($permiso) > 4){
            return [
                'message' => 'Aún tienes tokens activos',
                'status' => false,
                'postdata' => 'Para generar mas de 1 token a la vez cambie de plan'
            ];
        }
        
        DB::select("insert into permissions (user_id, limite, credit, consult, token, estado) values ('".$request->user_id."', '".$request->limit."', '".$request->credit."', '".$request->consult."', '".$token."', '1')");

        return [
            'message' => 'Token generado con éxito!',
            'status' => true
        ];
    }
    
}
