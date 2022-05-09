@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-primary  alert-dismissible" role="alert">
{{Session::get('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

</div>
@endif


<a href="{{url('producto/create')}}" class='btn btn-success'>Registrar nuevo producto </a>
<br />
<br />
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>obserciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($productos as $producto)

    <tr>

            <td>{{ $producto->id}}</td>

            <td>

           <img  class="img-thumbnail img-fluid" src="{{   asset('storage').'/'.$producto->imagen }}" width="100" alt="">

        </td>
           <td>{{ $producto->nombre}}</td>
            <td>{{ $producto->precio}}</td>
            <td>{{ $producto->cantidad}}</td>
            <td>{{ $producto->observacion}}</td>
            <td>


            <a href="{{url('/producto/'.$producto->id.'/edit') }}" class="btn btn-warning">
            Editar
            </a>
             |

            <form action="{{ url('/producto/'.$producto->id) }}" class="d-inline" method="POST">
                <!-- verificamos el token para eleminar solo dentro de la pagina -->
                @csrf
                {{ method_field('DELETE')}}
              <input type="submit" onclick="return confirm('Eliminar Producto?')"
                   value="Borrar" class="btn btn-danger">

            </form>

        </td>

        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
