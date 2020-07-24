<?php


namespace App\Http\Controllers;



use App\meaning;
use App\word_has_significance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Mockery\Exception;

class meaning_hasController
{
    public function __construct()
    {
        //
    }

    public function index(){
        try{
            $listado =  DB::table('word_has_significance')
                ->join('word', 'word_has_significance.word_id', '=', 'word.id')
                ->join('meaning', 'word_has_significance.meaning_id', '=', 'meaning.id')
                ->select('word_has_significance.*', 'word.word_text', 'meaning.meaning_text')
                ->get();
            return response()->json($listado,Response::HTTP_OK);

        }catch (Exception $ex){
            return response()->json([
                'error' => 'Hubo un error al listar : '. $ex->getMessage()
            ], 206);
        }
    }




    public function store(Request $request)
    {
        try{
            $has_significance = word_has_significance::create($request->all());
            return response()->json($has_significance, Response::HTTP_CREATED);

        }catch (Exception $ex){
            return response()->json([
                'error' => 'Hubo un error al registrar : '. $ex->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $has_significance= word_has_significance::findOrFail($id);
            $has_significance->update($request->all());
            return response()->json($has_significance,Response::HTTP_OK);

        }catch (Exception $ex){
            return response()->json([
                'error' => 'Hubo un error al actualizar el operativo con id => '.$id." : ". $ex->getMessage()
            ], 400);
        }
    }

    public  function  show(Request $request, $id)
    {
        try {
            $meaning = word_has_significance::findOrFail($id);
            return  response()->json($meaning,Response::HTTP_OK);
        } catch (Exception $ex)
        {
            return response()->json(['error'=> 'Hubo un problema al encontrar el esto'. $ex->getMessage()
            ],404);
        }

    }

    public function destroy(Request $request, $id)
    {
        try{
            word_has_significance::find($id)->delete();
            return response()->json([],Response::HTTP_OK);

        }catch (Exception $ex){
            return response()->json([
                'error' => 'Hubo un error al eliminar el operativo con id => '.$id." : ". $ex->getMessage()
            ], 400);
        }
    }
}
