@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')

@section('body-class', 'product-page')


@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">        

        <div class="section text-center">
            <h2 class="title">Agregar Sabor</h2>
               
               <h3 class="title">{{ $product->name }}</h3>

               <table class="table">
                <thead>
                    <tr>
                        <th class="col-md-2 text-center">Nombre</th>
                        <th class="text-right">cantidad</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sabores as $sabor)
                <tr>
                    <td class="text-right">{{ $sabor->description }}</td>
                    <td class="text-right">{{ $sabor->qty }}</td>
                    <td class="td-actions text-right">
                      <form method="get" action="{{ url('/admin/attributes_product/'.$sabor->id.'/'.$product->id.'') }}">
                      {{ csrf_field() }}

                            <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

               <form method="post" action="{{ url('/admin/attributes_product/') }}">
                {{ csrf_field() }}
                
                <div class="row">

                    <div class="col-sm-4">
                        <select class="form-control" name="attribute_id" required>
                            <option value="0">Selecciona un sabor</option>
                            @foreach ($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->description }}</option>
                            @endforeach
                        </select>                               
                    </div>

                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                            <i class="material-icons">add</i></span>
                            <input type="number" step="1" placeholder="Cantidad" name="qty" class="form-control" value="{{ old('quantyti') }}" required>
                        </div>                        
                    </div>
                    <input type="text" name="product_id" value="{{ $product->id }}" hidden>


               </div> 

               <button class="btn btn-primary">Añadir Sabor</button>
               <a href="{{ url('/admin/products') }}" class="btn btn-info">Terminar</a>


            </form>

        </div>


       
    </div>

</div>

@include('includes.footer')
@endsection

