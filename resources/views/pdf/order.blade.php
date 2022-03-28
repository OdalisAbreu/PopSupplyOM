<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css"> 
        .container{
            display: flex;
            justify-content: center;
        }
        .fact_herader{
            margin-bottom: 20px;
            background-color: rgb(191, 251, 255);
            padding: 16px 20px;
        }
        .contenido
        {
            padding: 13px !important;
            width: 600px;
        }
        .logo
        {   
            width: 225px;
        }
        .fact_footers{
            text-align: end;
        }
    </style>
    <title></title>
</head>
<body>
    <div class="container">

            <div id="imagen" class="contenido" >
                <div class="fact_herader">
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ asset('/images/logo/Botpro_logo.png') }}" class="logo">
                        </div>
                        <div class="col-6 text-end">
                            <?php echo date('d-m-Y'); ?>
                        </div>
                    </div>
                </div>
       
            
                <div class="empresa">
                <div class="row">
                    <div class="col-6">
                        BotPRo <br />
                    </div>
                    <div class="col-6">
                        Calle Paseo de los Locutores No.27 <br />
                        Evaristo Morales <br />
                        Distrito Nacional <br />
                        República Dominicana </p>
                    </div>
                </div>
                <hr>

                </div>     
                <div class="cliente">
                    <div class="row">
                        <div class="col-4">
                            Nombre:  <br />  {{$orders->user->name}}
                        </div>
                        <div class="col-4">
                            Direccion:  <br />  {{$orders->user->address}}
                        </div>
                        <div class="col-4">
                            Telefono:  <br />  {{$orders->user->phone}}
                        </div>
                    </div>
                    <hr>           
                </div>
                <div>
                <h3>  Orden de compra No. {{$orders->id }} </h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unidad</th>
                        <th>18 % ITBIS</th>
                        <th>Importe</th>
                    </tr>
                    @foreach ($orders->cart->details  as $cart)
                    <tr>
                        <td>{{$cart->product->name}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{ number_format($cart->product->price, 2)}}</td>
                        <td><?php echo number_format($cart->product->price *0.18, 2); ?> </td>
                        <td><?php echo number_format(($cart->product->price + ($cart->product->price *0.18)) * $cart->quantity, 2) ?> </td>
                    </tr>
                    @endforeach
                </table>
                    <div class="fact_footers">
                        <hr class="my-2">
                        SubTotal: RD$ {{number_format($orders->cart->total, 2)}} <br />
                        ITBIS: RD$ <?php echo number_format($orders->cart->total *0.18, 2); ?> <br />
                        Total: RD$ <?php echo number_format($orders->cart->total + ($orders->cart->total *0.18), 2); ?>
                        <hr class="my-4">
                    </div>
                
                El pago debe ser efectuado en un plazo de 3 días 
        
        </div>
    </div>
             
         
         <div style="padding: 18px !important;">
             <a id="btnSave" class="btn btn-info"> Descargar </a>
             
             @guest
              @else
                 <a href="{{ url('orders/'.$orders->id.'/Cancelado?type=canceladas')}}" class="btn btn-danger"> Cancelado </a>
             @endguest
        </div>


        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.js"></script>   

      <script>
        var node = document.getElementById('imagen');
        var btn = document.getElementById('btnSave');

        btn.onclick = function() {
        domtoimage.toBlob(document.getElementById('imagen'))
            .then(function(blob) {
            window.saveAs(blob, 'imagen');
            });
        }
   
      </script>
</body>
</html>