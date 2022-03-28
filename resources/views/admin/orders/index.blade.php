@extends('layouts.app')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')


@section('content')

<div class="header header-filter" style="background-image: url({{ asset('/public/img/bg1.jpg')}});">
</div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="?type=proceso">En Proceso</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?type=despachadas">Despachadas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?type=canceladas">Canceladas</a>
                </li>
              </ul>

            <table class="table table-success table-striped">
                <tr>
                    <th class="col-2 text-center"> Orden </th>
                    <th class="col-2 text-center"> Status </th>
                    <th class="col-2 text-center"> Nombre </th>
                    <th class="col-2 text-center"> Monto </th>
                    <th class="col-4 text-center"> Opciones </th>
                </tr>
                @if (empty($_GET['type']) or $_GET['type'] == 'proceso' )
                    @foreach ($orders as $order)
                        @if ($order->status == 'Pendiente' or $order->status == 'Facturado' or $order->status == 'Pagado')
                            <tr>
                                <td class="col-2"> <a href="{{ url('order/'.$order->id)}}"> Orden N. {{$order->id}} </a> </td>
                                <td class="col-2">{{$order->status}}</td>
                                <td class="col-2">{{$order->user->name}}</td>
                                <td class="col-2">{{$order->cart->total}}</td>
                                <td class="col-4">
                                    @if ($order->status == 'Pendiente')
                                    |
                                    <a href="{{ url('orders/'.$order->id.'/Facturado')}}" class="btn btn-warning"> Facturado </a>
                                    | 
                                    @elseif ($order->status == 'Facturado')
                                    |
                                    <a href="{{ url('orders/'.$order->id.'/Pagado')}}" class="btn btn-info"> Pagado </a>
                                    |
                                    @elseif ($order->status == 'Pagado')
                                    |  
                                    <a href="{{ url('orders/'.$order->id.'/Despachado')}}" class="btn btn-success"> Despachado </a>
                                    |
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
               @elseif (empty($_GET['type']) or $_GET['type'] == 'despachadas' )
                    @foreach ($orders as $order)
                        @if ($order->status == 'Despachado')
                            <tr>
                                <td class="col-2"> <a href="{{ url('order/'.$order->id)}}"> Orden N. {{$order->id}} </a> </td>
                                <td class="col-2">{{$order->status}}</td>
                                <td class="col-2">{{$order->user->name}}</td>
                                <td class="col-2">{{$order->cart->total}}</td>
                                <td class="col-4">
                                    @if ($order->status == 'Pendiente')
                                    |
                                    <a href="{{ url('orders/'.$order->id.'/Facturado')}}" class="btn btn-warning"> Facturado </a>
                                    | 
                                    @elseif ($order->status == 'Facturado')
                                    |
                                    <a href="{{ url('orders/'.$order->id.'/Pagado')}}" class="btn btn-info"> Pagado </a>
                                    |
                                    @elseif ($order->status == 'Pagado')
                                    |  
                                    <a href="{{ url('orders/'.$order->id.'/Despachado')}}" class="btn btn-success"> Despachado </a>
                                    |
                                    @endif
                                </td>
                            </tr>
                        @endif
                 @endforeach
                 @elseif (empty($_GET['type']) or $_GET['type'] == 'canceladas' )
                 @foreach ($orders as $order)
                     @if ($order->status == 'Cancelado')
                         <tr>
                             <td class="col-2"> <a href="{{ url('order/'.$order->id)}}"> Orden N. {{$order->id}} </a> </td>
                             <td class="col-2">{{$order->status}}</td>
                             <td class="col-2">{{$order->user->name}}</td>
                             <td class="col-2">{{$order->cart->total}}</td>
                             <td class="col-4">
                                 @if ($order->status == 'Pendiente')
                                 |
                                 <a href="{{ url('orders/'.$order->id.'/Facturado')}}" class="btn btn-warning"> Facturado </a>
                                 | 
                                 @elseif ($order->status == 'Facturado')
                                 |
                                 <a href="{{ url('orders/'.$order->id.'/Pagado')}}" class="btn btn-info"> Pagado </a>
                                 |
                                 @elseif ($order->status == 'Pagado')
                                 |  
                                 <a href="{{ url('orders/'.$order->id.'/Despachado')}}" class="btn btn-success"> Despachado </a>
                                 |
                                 @endif
                             </td>
                         </tr>
                     @endif
                 @endforeach
               @endif
            </table>
         </div>
    </div>
</div>



@include('includes.footer')
@endsection