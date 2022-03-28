<!-- Modal add to cart -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Selecciona la cantidad que deseas agregar</h4>
        </div>
        <form method="post" action="{{ url('/botcart') }}">
            {{ csrf_field() }}
        <input type="hidden" name="product_id" id="product_id" >
        <input type="hidden" name="user_id" id="user_id" >
            <div class="modal-body row">
                <div class="col-7">
                    <input type="number" class="form-control" name="quantity" id="quantity" value="1"> 
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger" onClick="disminuir()"> - </button> 
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-success" onClick="aumentar()"> + </button>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-info btn-simple">Agregar al carrito</button>
            </div>
        </form>
    </div>
    </div>
</div>



<!-- Modal remove to cart -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Carrito de Compras</h4>
        </div>
        

        @if ($cant_produc < 1)
            <h5>Usted no tiene productos en el carrito</h5> 
        @else
            @foreach ( $products_user as $product )
            <form method="post" action="{{ url('/botcart') }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="row">
                    <div class="col-3">
                        <img src="/images/products/{{ $product->image }}" class="img-thumbnail">
                    </div>
                    <div class="col-3 mt-4">
                        {{ $product->quantity }}
                    </div>
                    <div class="col-3 mt-4">
                        {{ $product->price }}
                    </div>
                    <div class="col-3 mt-4">
                        <input type="hidden" value="{{ $product->id }}" name="product_id"  >
                        <input type="hidden" value="{{ $product->quantity }}" name="quantity"  >
                        <input type="hidden" value="{{ $product->price }}" name="price"  >
                        <input type="hidden" value="{{ $id }}" name="user_id"  >
                        <input type="hidden" value="{{ $total }}" name="total"  >
                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" color="white">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            @endforeach
        @endif
            
            <div class="modal-footer">
            <button type="button" class="btn btn-default btn-simple" data-bs-dismiss="modal">Cancelar</button>
            </div>
    </div>
    </div>
</div>


<!-- Modal realizar pedido -->
<div class="modal fade" id="realizarPedidoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Carrito de Compras</h4>
        </div>
        

        @if ($cant_produc < 1)
            <h5>Usted no tiene productos en el carrito</h5> 
        @else
            @foreach ( $products_user as $product )
            <form method="post" action="{{ url('/botcart') }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="row">
                    <div class="col-3">
                        <img src="/images/products/{{ $product->image }}" class="img-thumbnail">
                    </div>
                    <div class="col-3 mt-4">
                        {{ $product->quantity }}
                    </div>
                    <div class="col-3 mt-4">
                        {{ $product->price }}
                    </div>
                    <div class="col-3 mt-4">
                        <input type="hidden" value="{{ $product->id }}" name="product_id"  >
                        <input type="hidden" value="{{ $product->quantity }}" name="quantity"  >
                        <input type="hidden" value="{{ $product->price }}" name="price"  >
                        <input type="hidden" value="{{ $id }}" name="user_id"  >
                        <input type="hidden" value="{{ $total }}" name="total"  >
                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" color="white">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            @endforeach
        @endif
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Seguir Comprando</button>
                <form method="post" action="{{ url('/orderbot') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $id }}" name="user_id">
                    <input type="hidden" value="{{ $cart_id }}" name="cart_id">
                    <input type="hidden" value="{{ $total }}" name="total"  >
                    <button type="submit" class="btn btn-primary"> Realizar Pedido </button>
                </form>
            </div>
    </div>
    </div>
</div>
