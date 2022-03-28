<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/botview.css">
    <style type="text/css"> 
        .container{
            display: flex;
            justify-content: center;
            min-width: 600px;
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
            background: white;
        }
        .logo
        {   
            width: 225px;
        }
        .fact_footers{
            text-align: end;
        }
    </style>
    <title>Bot</title>
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
                            Correo:  <br />  {{$orders->user->email}}
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
                    <?php $totalProduc = 0;?>
                    @foreach ($orders->cart->details  as $cart)
                    <tr>
                        <td>{{$cart->product->name}}</td>
                        <td>{{$cart->quantity}}</td>
                        <?php $totalProduc = $totalProduc + $cart->quantity; ?>
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

    <div class="container">
        <div class="row">
            <div>

                <form action='https://lab.cardnet.com.do/authorize' method='POST' name='CardNet' class='CardNet' id='CardNet'>
                    <input name='TransactionType' id='TransactionType' value='0200' type='hidden'/>
                    <input name='CurrencyCode' id='CurrencyCode' value='214' type='hidden'/>
                    <input name='AcquiringInstitutionCode' id='AcquiringInstitutionCode' value='349' type='hidden'/>
                    <input name='MerchantType' id='MerchantType' value='7997' type='hidden'/>
                    <input name='MerchantNumber' id='MerchantNumber' value='349000000 ' type='hidden'/>
                    <input name='MerchantTerminal' id='MerchantTerminal' value='58585858' type='hidden'/>
                    <input name='ReturnUrl' id='ReturnUrl' value='https://ordermanager.sendiu.net/api/pago' type='hidden'/>
                    <input name='CancelUrl' id='CancelUrl' value='https://ordermanager.sendiu.net/api/pago' type='hidden'/>
                    <input name='PageLanguaje' id='PageLanguaje' value='ESP' type='hidden' type='hidden'/>
                    <input name='OrdenId' id='OrdenId' value='{{ $orders->id }}'  type='hidden'/>
                    <input name='TransactionId' id='TransactionId' value='' type='hidden' type='hidden'/>
                    <input name='Amount' id='Amount' value='<?php echo $orders->cart->total + ($orders->cart->total *0.18); ?>' type='hidden'/>
                    <input name='Tax' id='Tax' value='<?php echo $orders->cart->total *0.18; ?>' type='hidden'/>
                    <input name='MerchantName' id='MerchantName' value='ORDER MANAGER DO' type='hidden'/>
                    <input name='KeyEncriptionKey' id='KeyEncriptionKey' value='" + key +"' type='hidden'/>
                    <input name='Ipclient' id='Ipclient' value='' type='hidden'/>
                    <input name='loteid' Value='001' type='hidden'/>
                    <input name='seqid' id='seqid' Value='001' type='hidden'/>
                </form>
                </div>
                <div class="col">
                    <form action="/api/pago" method="post" name='entrega' id='entrega'>
                        <input name='OrdenID' id='OrdenID' value='{{ $orders->id }}'  type='hidden'/>
                        <input name='image' id='image' value="" type='hidden'/>
                        <input name='ResponseCode' id='ResponseCode' value='1'  type='hidden'/>
                        <button type="submit" class="btn btn-primary">Pago contra entrega</button>
                    </form>
                </div>
                <div class="col">
                  <!-- <button type="button" onclick="doSubmit()"> Pago con TC </button> -->
                  <!--  <form action="/api/visanet" method="post" name='entrega2' id='entrega2'> -->
                <form action="https://pagos.sendiu.net/visa_net/pagos/" method="post" name='entrega2' id='entrega2'>
                    <input name='OrdenId' id='OrdenId' value='{{ $orders->id }}'  type='hidden'/>
                    <input name='sku' id='sku' value='<?php echo rand(1000, 9999); ?>'  type='hidden'/>
                    <input name='quantity' id='quantity' value='<?php echo $totalProduc; ?>'  type='hidden'/>
                    <input name='price' id='price' value='BotPro_Products'  type='hidden'/>
                    <input name='user_name' id='user_name' value='{{ $orders->user->name }}'  type='hidden'/>
                    <input name='user' id='user' value='{{$orders->user->email}}'  type='hidden'/>
                    <input name='email' id='email' value='{{$orders->user->email}}'  type='hidden'/>
                    <input name='phone' id='phone' value='{{$orders->user->phone}}'  type='hidden'/>
                    <input name='conversation_number' id='conversation_number' value='{{$orders->user->remember_token}}'  type='hidden'/>
                    <input name='price' id='price' value='<?php echo $orders->cart->total + ($orders->cart->total *0.18); ?>' type='hidden'/>
                    <button type="submit" class="btn btn-primary">Pago con Tarjeta</button>
                </form>
                </div>
                <div class="col">
                    <a id="btnSave" class="btn btn-info"> Descargar Factura</a>
                </div>
        </div>
    </div>

    <script src="js/md5.min.js"></script>
    <!--Descargar en: https://github.com/alex0360/cifrado-->
    <script src="js/app.js"></script>
    <script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../js/bot.js"></script>


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

        domtoimage.toPng(node).then(function (dataUrl) {
            var img = new Image();
            console.log(dataUrl)
            document.entrega.image.value = dataUrl
            document.entrega2.image2.value = dataUrl
            img.src = dataUrl;
        }).catch(function (error) {
            console.error('oops, something went wrong!', error);
        });


    </script>

</body>
</html>