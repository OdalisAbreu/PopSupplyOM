<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>VisanNet - BotPro</title>
    <style type="text/css">
        .row{
            padding: 10px
        }
        .container{
            padding-left: 20px;
            width: 500px;
        }
        .btn{
            padding: 10px 10px;
            margin: 0px 28px;
        }
        form{
            display: grid;
        }
    </style>


</head>
<body>
        <div class="container">
            <div class="logo">
                <img src="/images/logo/Visanet.jpg" alt="">
            </div>
            <div class="encabezado border border-3 rounded">
                <div class="row">
                    <div class="col-6">
                        <b>Empresa:</b> 
                    </div>
                    <div class="col-6">
                        <label>SENDIU </label>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-6">
                            <b>Moneda:</b> 
                        </div>
                        <div class="col-6">
                            <label>Peso Dominicano</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <b>Monto a Pagar:</b> 
                        </div>
                        <div class="col-6">
                            <label>RD$ {{ $order->Amount }}.00</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <b>Factura No.:</b> 
                        </div>
                        <div class="col-6">
                            <label> {{ $order->OrdenId }} </label>
                    </div>
                 </div>
            </div>
        
            
            <form action="/api/pago"  method="post" name='entrega' id='entrega'>
                <div class="row">
                     <input type="text" name="nombre" class="form-control" placeholder='Nombre del Tarjetahabiente' required>     
                </div>
                <div class="row">
                    <input type="text" name="numero" class="form-control" placeholder="Número de Tarjeta" required>                
                </div>
                <div class="row">
                   <input type="text" name="fecha" class="form-control" placeholder="Fecha de Expiración" required>                
                </div>
                <div class="row">
                    <input type="text" name="cvv" class="form-control" placeholder="CVV" required>                
                </div>

                <input name='OrdenID' id='OrdenID' value='{{ $order->OrdenId }}' type='hidden' />
                <input name='Tax' id='Tax' value='<?php echo $order->Amount *0.18; ?>' type='hidden'/>
                <input name='Amount' id='Amount' value='<?php echo $order->Amount + ($order->Amount *0.18); ?>' type='hidden'/>
                <input name='image' id='image' value="{{ $order->image2 }}" type='hidden'/>
                <input name='ResponseCode' id='ResponseCode' value='1'  type='hidden'/>
                <button type="submit" class="btn btn-primary">PAGAR</button>
            </form>
        </div>
</body>
</html>