<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cart;
use App\CartDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;

class CartController extends Controller
{

	public function update()
	{
		$client = auth()->user();

		$order = new Order();
		$order->cart_id = $client->cart->id;
		$order->user_id = $client->cart->user_id;
		$order->status = 'Pendiente';
		$order->save();

		$cart = $client->cart;
		$cart->status = 'Pending';
		$cart->order_date = Carbon::now();
		$cart->total = $client->cart->total;
		$cart->update();      		// UPDATE

		//$admins = User::where('admin', true)->get();
		//Aqui podemos agregar copia del correo para el cliente,
		//para pruebas solo envía al correo del admin
		//Mail::to($admins)->send(new NewOrder($client, $cart));

		//$msg = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail!';
		//return back()->with(compact('msg'));
		return redirect('home');
	}
	public function crearcarrtito(Request $request)
	{
		// Validar si esta creado ya el carrito 
		$existe = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->exists();
		
		//Buscar el atributo de producto y Validar si corresponde al producto
		$atributo = DB::table('products_attributes')->where([['product_id', $request->product_id],['attribute_id',$request->attribute_id]])->get();
		if(empty(json_decode($atributo))){
			return '{"id": 0, "status": "FAIL"}';
		}
		//calcular el total de la factura antes de guardar 
		if ($existe) {
			$cart = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->get();
			$precio =  DB::table('products')->where('id', $request->product_id)->get();;
			
			$precio_cart =  $cart[0]->total;
			$total = ($precio[0]->price * $request->quantity) + $precio_cart;
		
			// Carga un nuevo producto al carrito
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart[0]->id;
			$cartDetail->product_id = $request->product_id;
			$cartDetail->products_attribute_id = $request->attribute_id;
			$cartDetail->quantity = $request->quantity;
			$cartDetail->save();
			//Actualiza el total del carrito
			DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->update(['total' => $total]);
			$cart = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->select('id','total')->get();
			app(AttributesController::class)->addProduct($request->attribute_id, $request->quantity); 
			
			return response()->json($cart);
			// return '{ "total":'.$total.' }';
		} else {
			//calcular el precio del producto
			$precio =  DB::table('products')->where('id', $request->product_id)->get();
			$total = $precio[0]->price * $request->quantity;

			// Crea un nuevo carrito
			$cart = new Cart();
			$cart->user_id = $request->user_id;
			$cart->status = 'Active';
			$cart->order_date = Carbon::now();
			$cart->total = $total;
			$cart->Save();
			//carga el primer producto en el carrito
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart->id;
			$cartDetail->product_id = $request->product_id;
			$cartDetail->products_attribute_id = $request->attribute_id;
			$cartDetail->quantity = $request->quantity;
			$cartDetail->save();
			
			app(AttributesController::class)->addProduct($request->attribute_id, $request->quantity);

			return response()->json($cart);
			//return '{ "total":'.$total.' }';
		}
	}

	public function store(Request $request)  // Agregar los productos desde la vista del Bot
	{


		// Validar si esta creado ya el carrito 
		$existe = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->exists();
		//calcular el total de la factura antes de guardar 

		if ($existe) {
			$cart = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->get();
			$precio_producto =  DB::table('products')->where('id', $request->product_id)->get();
			$precio_cart =  $cart[0]->total;
			$total = ($precio_producto[0]->price * $request->quantity) + $precio_cart;

			// Carga un nuevo producto al carrito
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart[0]->id;
			$cartDetail->product_id = $request->product_id;
			$cartDetail->quantity = $request->quantity;
			$cartDetail->save();
			//Actualiza el total del carrito
			DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->update(['total' => $total]);

			$cart = DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->get();

			$cant_produc = DB::table('cart_details')->where('cart_id', $cart[0]->id)->count();
		} else {
			//calcular el precio del producto
			$precio =  DB::table('products')->where('id', $request->product_id)->get();
			$total = $precio[0]->price * $request->quantity;
			// Crea un nuevo carrito
			$cart = new Cart();
			$cart->user_id = $request->user_id;
			$cart->status = 'Active';
			$cart->order_date = Carbon::now();
			$cart->total = $total;
			$cart->Save();
			//carga el primer producto en el carrito
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart->id;
			$cartDetail->product_id = $request->product_id;
			$cartDetail->quantity = $request->quantity;
			$cartDetail->save();

			$cant_produc = DB::table('cart_details')->where('cart_id', $cart->id)->count();
		}



		$msg = "Producto agregado al carrito";
		return back()->with(compact('msg', 'total', 'cant_produc'));
	}

	public function destroy(Request $request)
	{

		$total = $request->total - ($request->quantity * $request->price);

		DB::table('cart_details')->where('id', '=', $request->product_id)->delete();
		DB::table('carts')->where([['user_id', $request->user_id], ['status', 'Active']])->update(['total' => $total]);


		return back()->with(compact('total'));
	}
}
