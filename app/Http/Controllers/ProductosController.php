<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\Double;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['productos']=Productos::paginate(30);  // listamos los datos
        return view ('producto.index',$datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // $datosProductos= request()->all();
       // compos para validar
       $campos=[
           'nombre'=>'required|string|max:40',

           'cantidad'=>'required|integer|max:40',

           'observacion'=>'required|string|max:500',
       ];
       //creamos los mensajes para el usuario
       $mensaje=[
           'request'=>'El :attribute es requerido',

       ];
       // unimos los mensajes
       $this->validate($request,$campos,$mensaje);

       $datosProductos= request()->except('_token'); // quitamos el token
       if($request->hasFile('imagen')){
           $datosProductos['imagen']=$request->file('imagen')->store('uploads','public');// alteramos el campo del la imagen  y agregamos la ruta
       }
       Productos::insert($datosProductos); // enviamos a la base de datos
      //  return response()->json($datosProductos);
      return redirect ('producto')->with('mensaje','Producto agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $producto=Productos::findOrFail($id);

        return view ('producto.edit',compact('producto'));// pasamos la informacion al formulario
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, $id)
     {
        //
        $campos=[
            'nombre'=>'required|string|max:40',

            'cantidad'=>'required|integer|max:40',

            'observacion'=>'required|string|max:500',
        ];
        //creamos los mensajes para el usuario
        $mensaje=[
            'request'=>'El :attribute es requerido',
         ];
         //VALIDAMOS PARA QUE EL USAURIO NO TENGA QUE RECARGAR OTRA VEZ LA FOTO
        if($request->hasFile('imagen')){
            $campos=[ 'foto'=>'required|max:400|mimes:jpeg,png,jpg'];
            $mensaje=[
                  'imagen'=>'La imagen es requeridad'
            ];
        }


        // unimos los mensajes
        $this->validate($request,$campos,$mensaje);


       $datosProductos= request()->except(['_token','_method']); // quitamos el token
        if($request->hasFile('imagen')){
            $producto=Productos::findOrFail($id);
            Storage::delete('public/'.$producto->imagen);// borramos la imagen anterior
        $datosProductos['imagen']=$request->file('imagen')->store('uploads','public');// alteramos el campo del la imagen  y agregamos la ruta
     }
        Productos::where('id','=',$id)->update($datosProductos);

        $producto=Productos::findOrFail($id); // buscamos la informacion con el id editado

      //  return view ('producto.edit',compact('producto'));// pasamos la informacion al formulario

      return redirect ('producto')->with('mensaje','Producto Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto=Productos::findOrFail($id);
        // preguntamos si la imagen existe
        if(Storage::delete('public/'.$producto->imagen)){
            Productos::destroy($id);
        }
        Productos::destroy($id);
       // return  redirect('producto');
        return redirect ('producto')->with('mensaje','Producto eliminado con exito');
    }
}
