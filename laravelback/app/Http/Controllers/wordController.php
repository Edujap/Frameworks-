<?php


namespace App\Http\Controllers;
use App\word_has_significance;
use App\word;
use App\word_has_synonymous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Symfony\Component\HttpFoundation\Response;


class wordController
{
    public function _construct()
    {

    }
    public function  index()
        { try{
            $listado= word::all();
            return response()->json($listado, Response:: HTTP_OK);
        }catch (Exception $ex){
            return response()->json([
                'error' => 'Hubo un problema al listar todas las palabras'. $ex->getMessage()
            ],206);
    }
    }
    public  function  show(Request $request, $id)
    {
        try {
            $word = word::findOrFail($id);
            return  response()->json($word,Response::HTTP_OK);
        } catch (Exception $ex)
        {
            return response()->json(['error'=> 'Hubo un problema al encontrar la palabra'. $ex->getMessage()
            ],404);
        }

    }
    public function  store(Request $request)
    {
        try{
            $word =word::create ($request->all());
            return  response()->json($word, Response::HTTP_OK);
        } catch(Exception $ex) {
            return response()->json(['error'=>'Hubo un problema al crear la palabra'.$ex->getMessage()],
                400);
        }
    }
    public function  update(Request $request, $id){
        try{
            $word = word::findOrFail($id);
            $word->update($request->all());
            return response()->json($word, Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al actualizar la palabra con id => '.$id." : ". $ex->getMessage()
            ],400);
        }
    }
    public function  destroy(Request $request,$id){

        try{

            $sigfni= word_has_significance::select('*')->where('word_id', '=', $id)->get();
            $sinonimo= word_has_synonymous::select('*')->where('word_id', '=', $id)->get();
            foreach ($sigfni as $elemento ) {
                $elemento->delete();
            }
            foreach ($sinonimo as $elemento ) {
                $elemento->delete();
            }

            word::find($id)->delete();
            return response()->json([],Response::HTTP_OK);
        } catch (Exception $ex){
            return response()->json(['error' => 'Hubo un error al eliminar la palabra con id => '.$id." : ". $ex->getMessage()
            ],400);
        }

    }


}
