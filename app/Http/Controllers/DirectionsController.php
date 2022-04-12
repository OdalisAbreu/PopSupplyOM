<?php

namespace App\Http\Controllers;

use App\Directions;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Support\Facades\DB;

class DirectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

   
    public function destroy(Directions $directions)
    {
        //
    }

    public function map(){
       
        $gmap = new GMaps();

       // $config['center'] = '{ lat: -34.397, lng: 120.644 }';
       $config['center'] = '18.445480, -69.950365';
        $config['zoom'] = '14';
        $config['map_height'] = '600px'; 
        //$config['map_width'] = '500px';
       // $config['scrollwheel'] = false;
        
        $gmap->initialize($config);

        //Añadir marca
        $marker['position'] = '18.445480, -69.950365';
        //$marker['location'] = '18.463142, -69.941539';
        // $marker['infowindow_content'] = '18.463142, -69.941539';
        //$marker['icon'] = 'URL';
        $gmap->add_marker($marker);


        $map = $gmap->create_map();



        return view('admin.orders.map')->with('map', $map);
    }

    public function guardarMap(Request $request){
       
        $existe =  DB::table('directions')->where(['user_id'=>$request->user_id, 'lat'=>$request->lat, 'log'=>$request->log])->exists();

        if($existe){
            $name_dirrecion =  DB::table('directions')->where(['user_id'=>$request->user_id, 'lat'=>$request->lat, 'log'=>$request->log])->get('name');
            $nombre = $name_dirrecion[0]->name;
            $mensaje = '{ "message": "Esta dirección ya fue registrada con el nombre: '.$nombre.'" }';
        }else{
            $direction = new Directions();
            $direction->name = $request->name;
            $direction->description = $request->description;
            $direction->lat = $request->lat;
            $direction->log = $request->log;
            $direction->user_id = $request->user_id;
            $direction->save();

            $mensaje = '{ "message": "Dirección registrada correctamente", "direcction_id": "'.$direction->id.'" }';
        }

        return $mensaje;

    }

    public function consultmap($coordenadas){

        $coordenadas = str_replace(',','.', $coordenadas);
        $coordenadas = str_replace(': -',':-', $coordenadas);
        $coordenadas = str_replace('. ',' & ', $coordenadas);
        $direction = explode(" ",$coordenadas);
        $lat = $direction[1];
        $long1 = $direction[3];
        $long2 = explode(":",$long1);
        $long = $long2[1];

        $json = '{"lat": "'.$lat.'", "long": "'.$long.'"}' ;

        return $json;

    }

    
    public function verdirection($user_id){
        $value ="";
        $existe = DB::table('directions')->where('user_id', $user_id)->exists();

        if($existe){
            $direcciones = DB::table('directions')->where('user_id', $user_id)->get();

            foreach ($direcciones as $direccion){

                $value .= '::'.$direccion->name;
            }
            $mensaje =  '{ "mensaje": "'.$value.'"}';
        }else{
            $mensaje = '{"mensaje": "Usted no tiene direcciones Registradas"}';
        }

        return $mensaje;
    }

    public function validardirrecion($user_id, $name_direcction){

        $existe = DB::table('directions')->where(['user_id'=>$user_id,'name'=>$name_direcction])->exists();

        if($existe){
            $direction = DB::table('directions')->where(['user_id'=>$user_id,'name'=>$name_direcction])->get();

          //  return $direction;
           return '{"existe": "ok", "direction_id": "'.$direction[0]->id.'", "description": "'.$direction[0]->description.'" }';
        }
    }

    public function notedirection($id,$note){
        DB::table('directions')->where('id',$id)->update(['note'=>$note]);

        return '{"mensaje": "Nota agregada correctamente"}';
    }
}
