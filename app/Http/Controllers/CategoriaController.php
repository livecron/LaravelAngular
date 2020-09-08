<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categria = new Categoria();
//        $categria->nombre = 'Cerialeshjsdf';
//        $categria->descripcion = ' todo los ceriales';
//        $categria->save();

        $categorias = Categoria::all();
        return response()->json(['data' => $categorias, 'status_code' => 200, 'state' => true]);

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
    public function store(CategoriaRequest $request)
    {
        $model = new Categoria($request->all());
        if ( $model->save()) {
            return  response()->json(['data' => $model]);
        } else {
            return  response()->json(['data' => null]);
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
        $model = Categoria::find($id);
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
        $model = Categoria::find($id);
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
        $model = Categoria::find($id);

        if($model->delete()) {
            return response()->json(['data'=>$id, 'state_code'=>200, 'status'=>true]);
        } else {

            return response()->json(['data'=>$id, 'state_code'=>401, 'status'=>false]);
        }


    }
}
