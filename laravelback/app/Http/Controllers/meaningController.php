<?php


namespace App\Http\Controllers;


use App\meaning;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class meaningController
{
    public function _construct()
    {

    }
    public function  index()
    { try{
        $listado= meaning::all();
        return response()->json($listado, Response:: HTTP_OK);
    }catch (Exception $ex){
        return response()->json([
            'error' => 'Hubo un problema al listar todas los significados'. $ex->getMessage()
        ],206);
    }
    }
    public  function  show(Request $request, $id)
    {
        try {
            $meaning = meaning::findOrFail($id);
            return  response()->json($meaning,Response::HTTP_OK);
        } catch (Exception $ex)
        {
            return response()->json(['error'=> 'Hubo un problema al encontrar el siginificado'. $ex->getMessage()
            ],404);
        }

    }
    public function  store(Request $request)
    {
        try{
            $meaning =meaning::create($request->all());
            return  response()->json($meaning, Response::HTTP_OK);
        } catch(Exception $ex) {
            return response()->json(['error'=>'Hubo un problema al crear el siginificado'.$ex->getMessage()],
                400);
        }
    }
    public function  update(Request $request, $id){
        try{
            $meaning = meaning::findOrFail($id);
            $meaning->update($request->all());
            return response()->json($meaning, Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al actualizar  el siginificado con id => '.$id." : ". $ex->getMessage()
            ],400);
        }
    }
    public function  destroy(Request $request,$id){
        try{
            meaning::find($id)->delete();
            return response()->json([],Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al eliminar el siginificadocon id => '.$id." : ". $ex->getMessage()
            ],400);
        }

    }



}
