<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PedidosController extends Controller
{
 /*   public function exportPdf()
    {
        $orders['orders'] = Order::get();
        $pdf = PDF::loadView('pdf.order', $orders)->with('user','cart' );

        return $pdf->download('order.pdf');;
    }*/

    public function show($id)
    {
        //
        $orders['orders'] = Order::find($id);
        return view('pdf.order',$orders)->with('user','cart' );
//        $orders = Order::find($id);
//        return view('pdf.order',$orders)->with('cart');
        
    }

    public function pago(Request $request){
        
    $orderId = $request->OrdenID;
    $ResponseCode = $request->ResponseCode;

    

    
    $tokent =  DB::table('orders')
    ->join('users','orders.user_id', '=', 'users.id')
    ->where('orders.id', $orderId)
    ->select('orders.id', 'users.remember_token')
    ->get();  
    
   
        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.png';
        Storage::disk('public')->put('image/facturas/'.$imageName, base64_decode($image));
      //  $old = '../storage/app/public/image/facturas/'.$imageName; //local
     $old = 'sendiupedidos/storage/app/public/image/facturas/'.$imageName;  //production
        $newRuta = 'images/facturas/'.$imageName;
     
        if(copy($old, $newRuta)){

            unlink($old);//eliminamos el original

        }else{
            
            return response()->json(['mensaje'=>'No se pudo mover el archivo']);
        }

        DB::table('orders')->where('id', $orderId)->update(["image64" => $newRuta,'updated_at'=> Carbon::now()]);//Actualiza el campo imagen
    

    $botpro_conversationId = $tokent[0]->remember_token;
    

    $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://botpro35.azurewebsites.net/api/v1/Hooks/Conversation?botpro_conversationId='.$botpro_conversationId.'&variable=OrderId&value='.$orderId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: ARRAffinity=8a04808bf31407f38566f64be531143f3be18392806dd1f91d6485b3824dbba3; ARRAffinitySameSite=8a04808bf31407f38566f64be531143f3be18392806dd1f91d6485b3824dbba3'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        DB::table('users')->where('remember_token', $botpro_conversationId)->update(["remember_token" => str_random(20),'updated_at'=> Carbon::now()]);//Actualiza el tokent

        return view('pagos.completo');
    }

    public function pagoVisanet(Request $request){
        $order = $request;
        $id =  $order->OrdenId;
        return view('pagos.visanet')->with(compact('order', 'id' ));
    }

}
