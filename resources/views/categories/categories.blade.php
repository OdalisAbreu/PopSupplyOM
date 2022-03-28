<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/botview.css">
    <title>Bot</title>
</head>
<body>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <h1>Productos</h1>
                @foreach ( $products as  $category )
                    <div class="row">
                        <h3>
                            {{ $category->name }}
                        </h3> 
                        <div class="row">
                            @foreach ( $category->products as  $product )
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-cel">
                                    <div class="row">
                                        <br /> 
                                        <img src="{{ $product->featured_image_url }}">
                                        <div class="title">{{ $product->name }}</div>
                                    </div>
                                    <div class="row">
                                        <br /> 
                                        <div class="add">
                                            <span class="price"> RD$ {{ $product->price }} </span>                                            
                                            <button type="button" onClick="pasarId({{ $product->id }}, {{ $id }})" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#addModal"> + <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                              </svg> </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                    </div>
                @endforeach
  
        </div>
    </div>
  
   
</div><br /><br />
<footer class="fixed-bottom border">
    <span class="col-4">
        <a type="button"  data-bs-toggle="modal" data-bs-target="#editModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
              </svg> 
              @if (session('cant_produc'))
                 <label class="btn btn-danger rounded-pill">{{ session('cant_produc') }}</label>
              @else
              <label class="btn btn-danger rounded-pill"> {{ $cant_produc }} </label>
              @endif
            </a>
    </span>
    <span class="col-4">
            @if(session('total'))
                Tota: RD$ {{ session('total') }} 
            @else
                Tota: RD$ {{ $total }}
            @endif
    </span>
    @if ($cant_produc > 0)
        <span class="col-4">
            <a type="button"  data-bs-toggle="modal" data-bs-target="#realizarPedidoModal" class="btn btn-secondary"> Finalizar </a>
        </span>
   @endif
</footer>


@include('includes.modals')


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../js/bot.js"></script>
</body>
</html>
