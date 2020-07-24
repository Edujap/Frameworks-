<?php


namespace App\Http\Controllers;


use App\synonymous;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class sinonimoController
{
    public function _construct()
    {

    }
    public function  index()
    { try{
        $listado= synonymous::all();
        return response()->json($listado, Response:: HTTP_OK);
    }catch (Exception $ex){
        return response()->json([
            'error' => 'Hubo un problema al listar todas el sinonimo'. $ex->getMessage()
        ],206);
    }
    }
    public  function  show(Request $request, $id)
    {
        try {
            $sinonimo = synonymous::find($id);
            return  response()->json($sinonimo,Response::HTTP_OK);
        } catch (Exception $ex)
        {
            return response()->json(['error'=> 'Hubo un problema al encontrar el sinonimo'. $ex->getMessage()
            ],404);
        }

    }
    public function  store(Request $request)
    {

        try{
            $sinonimo =synonymous::create ($request->all());
            return  response()->json($sinonimo, Response::HTTP_OK);
        } catch(Exception $ex) {
            return response()->json(['error'=>'Hubo un problema al crear el sinonimo'.$ex->getMessage()],
                400);
        }
    }
    public function  update(Request $request, $id){
        try{
            $sinonimo = synonymous::findOrFail($id);
            $sinonimo->update($request->all());
            return response()->json($sinonimo, Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al actualizar el sinonimo con id => '.$id." : ". $ex->getMessage()
            ],400);
        }
    }
    public function  destroy(Request $request,$id){
        try{
            synonymous::find($id)->delete();
            return response()->json([],Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al eliminar el sinonimo con id => '.$id." : ". $ex->getMessage()
            ],400);
        }

    }
}
