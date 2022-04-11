@extends('layouts.app')

@section('title', 'Listado de categorias')

@section('body-class', 'product-page')


@section('content')
<div class="header header-filter" style="background-image: url({{ asset('/public/img/bg1.jpg')}});">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <div class="row">
                <div class="col-sm-9 text-center">
                                <h2 class="title">Listado de categorias</h2>
                </div>
                <div class="col-sm-3">
                    <a href ="{{ url('/admin/attributes/create') }}" class="btn btn-primary btn-just-icon" title="Nueva categoria">
                        <i class="material-icons">note_add</i>
                    </a>                   
                </div>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-info">
                  <strong> {{ Session::get('msg') }}</strong>
                </div>
           
            @endif


            <div class="team">
                <div class="row">    
                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Sabor</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($attributes as $attribute)
                        <tr>
                            <td class="text-center">{{ $attribute->id }}</td>
                            <td>{{ $attribute->description }}</td>
                            <td class="td-actions text-center">
                              
                              <form method="post" action="{{ url('/admin/attributes/'.$attribute->id ) }}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                                <!--
                                <a rel="tooltip" title="Ver Categoria" class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-info"></i>
                                </a>
                                -->
                                <a  href="{{ url('/admin/attributes/'.$attribute->id.'/edit') }}" rel="tooltip" title="Editar Categoria" class="btn btn-success btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </a>                                   
                                <!--
                                 <a href="{{ url('/admin/attributes/'.$attribute->id.'/images') }}" rel="tooltip" title="Imágen de la categoría" class="btn btn-warning btn-simple btn-xs">
                                    <i class="fa fa-image"></i>
                                </a>
                                -->
                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $attributes->links() }}
                </div>
            </div>

        </div>

        
    </div>

</div>

@include('includes.footer')
@endsection

