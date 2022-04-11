<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ClienteController extends Controller
{
    public function crearcliente(Request $request){

      $existe = DB::table('users')->where('phone',$request->phone)->exists();

      if ($existe){
        $mensaje = '{ "mensaje": "El celular de este usuario ya está registrado"}';
        return $mensaje;
      }else{
          DB::table('users')->insert([
            ['name'=>$request->name, 'email'=>$request->email, 'phone' =>$request->phone, 'password' =>bcrypt($request->phone), 'remember_token' => $request->token,'created_at'=> Carbon::now()]
          ]);
    
          $user = DB::table('users')->where('phone', $request->phone)->get();
          return response()->json($user);
      }

    }

    public function existecliente(Request $request){
        $existe = DB::table('users')->where('phone',$request->phone)->exists();
        if($existe){
            DB::table('users')->where('phone', $request->phone)->update(["remember_token" => $request->token,'updated_at'=> Carbon::now()]);
            $user = DB::table('users')->where('phone', $request->phone)->select('id','name','email','phone','remember_token')->get();
           return response()->json($user);
        }else{
            $mensaje = '{ "id": 0, "name": "NULL"}';
        return $mensaje;
        }
  
    }

}
