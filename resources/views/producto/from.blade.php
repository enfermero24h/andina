<h1>{{ $modo }} Producto </h1>


@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}} </li>
@endforeach
</ul>
</div>
@endif

<div class="form-group">
<label for="Nombre" >Nombre</label>
<input type="text" class="form-control" name="nombre" id="nombre" value="{{isset( $producto->nombre)?$producto->nombre:old('nombre')}}"></input>
<br>
</div>
<div class="form-group">
<label for="Precio" >Precio</label>
<input type="double" name="precio" class="form-control" id="precio" value="{{isset($producto->precio )?$producto->precio:old('precio')}}"></input>
<br>
</div>

<div class="form-group">
<label for="Cantidad" >Cantidad</label>
<input type="integer" name="cantidad" class="form-control" id="cantidad" value="{{isset($producto->cantidad)?$producto->cantidad:old('cantidad')}}"></input>
<br>
</div>
<div class="form-group">
<label for="Imagen" ></label>
@if(isset($producto->imagen))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$producto->imagen }}" width="100" alt="">
@endif

<input type="file" name="imagen" id="imagen" ></input>
<br>
<label for="Observacion" >Observacion</label>
<input type="text"   class="form-control" name="observacion" id="observacion" value="{{ isset($producto->observacion)?$producto->observacion:old('observacion')}}"></input>
<br>
</div>
<input class="btn btn-success" type="submit" value="{{ $modo }} datos"></input>

<a  class="btn btn-primary" href="{{url('producto/')}}">Regresar </a>
<br>
