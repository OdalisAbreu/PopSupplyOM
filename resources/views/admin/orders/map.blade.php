@extends('layouts.app')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')

@section('content')
{!! $map['js'] !!}

<div class="header header-filter" style="background-image: url({{ asset('/public/img/bg1.jpg')}});">
</div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            
            {!! $map['html'] !!}
         </div>
    </div>
</div>


@include('includes.footer')
@endsection