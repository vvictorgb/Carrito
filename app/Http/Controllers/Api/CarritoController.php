<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $idUsuario = $request->idUsuario;
        $carros = Carrito::where('idUsuario',$idUsuario)->get();
        return response()->json($carros,200);
    }
    public function store(Request $request)
    {
        if(Carrito::where('idUsuario',$request->idUsuario)->where('idProducto',$request->idProducto)->count() == 0){
            $carro = new Carrito();
            $nlinea = Carrito::where('idUsuario',$request->idUsuario)->max('nlinea');
            $carro->nlinea = $nlinea + 1;
            $carro->idProducto = $request->idProducto;
            $carro->cantidad = $request->cantidad;
            $carro->idUsuario = $request->idUsuario;
            $carro->save();
            return response()->json($carro,200);
        }else{
            return $this->update($request->idUsuario,$request->idProducto, $request->cantidad);
        }

    }
    public function show($id)
    {
        $cantidad = Carrito::where('idUsuario', $id)->count();
        return response()->json([
            'cantidad' => $cantidad
        ], 200);
    }
    public function update($idUsuario, $idProducto, $cantidad)
    {
        $carro = Carrito::where('idUsuario',$idUsuario)->where('idProducto',$idProducto)->first();
        $carro->cantidad = $cantidad;
        $carro->save();
        return response()->json($carro,201);
    }
    public function destroy(Request $request)
    {
        $carro = Carrito::where('idUsuario',$request->idUsuario)->where('idProducto',$request->idProducto)->first();
        $carro->delete();
        return response()->json(null,200);
    }
    public function destroyAll($id){
        $carros = Carrito::where('idUsuario',$id)->get();
        foreach($carros as $carro){
            $carro->delete();
        }
        return response()->json(null,200);
    }
}
