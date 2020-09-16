<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json(['data'=>$productos, 'state'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        $model = new Producto($request->all());
        if ( $model->save()) {
            return  response()->json(['data' => $model, 'state'=>true, 'statusCode'=>201], 201);
        } else {
            return  response()->json(['data' => $model, 'state'=>false, 'statusCode'=>400], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Producto::find($id);
        return  response()->json(['data' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Producto::find($id);
        $model->fill($request->all());
        if ( $model->save()) {
            return response()->json(['data'=> $model, 'state_code'=> 200, 'state'=>true]);
        } else {
            return response()->json(['data'=> null, 'state_code'=> 401, 'state'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Producto::find($id);

        if($model->delete()) {
            return response()->json(['data'=>$id, 'state_code'=>200, 'status'=>true]);
        } else {

            return response()->json(['data'=>$id, 'state_code'=>401, 'status'=>false]);
        }

    }
}
