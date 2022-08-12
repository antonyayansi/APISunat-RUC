<?php

namespace App\Http\Controllers;

use App\Models\Permission;
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

        DB::select("insert into permissions (user_id, limite, credit, consult, token, estado) values ('".$request->user_id."', '".$request->limit."', '".$request->credit."', '".$request->consult."', '".$token."', '1')");

        return [
            'message' => 'Token generado con éxito!',
            'status' => true
        ];
    }
    
}
