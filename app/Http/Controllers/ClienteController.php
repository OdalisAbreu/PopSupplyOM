<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ClienteController extends Controller
{
    public function crearcliente($name, $email, $phone, $token){

      $existe = DB::table('users')->where('email',$email)->exists();

      if ($existe){
        $mensaje = '{ "mensaje": "Creado"}';
        return $mensaje;
      }else{
          DB::table('users')->insert([
            ['name'=>$name, 'email'=>$email, 'phone' =>$phone, 'password' =>bcrypt($phone), 'remember_token' => $token,'created_at'=> Carbon::now()]
          ]);
    
          $user = DB::table('users')->where('phone', $phone)->get();
          return response()->json($user);
      }

    }

    public function existecliente($phone, $token){
        $existe = DB::table('users')->where('phone',$phone)->exists();
        if($existe){
            DB::table('users')->where('phone', $phone)->update(["remember_token" => $token,'updated_at'=> Carbon::now()]);
            $user = DB::table('users')->where('phone', $phone)->get();
           return response()->json($user);
        }else{
            $mensaje = '{ "id": 0, "name": "NULL"}';
        return $mensaje;
        }
  
    }

}
