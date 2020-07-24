<?php


namespace App\Http\Controllers;


use App\word_has_synonymous;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Mockery\Exception;


class sinonimo_HasController
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        try {
            $listado = DB::table('word_has_synonymous')
                ->join('word', 'word_has_synonymous.word_id', '=', 'word.id')
                ->join('sinonimo', 'word_has_synonymous.sinonimo_id', '=', 'sinonimo.id')
                ->select('word_has_synonymous.*', 'word.word_text', 'sinonimo.description')
                ->get();
            return response()->json($listado, Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al listar : ' . $ex->getMessage()
            ], 206);
        }
    }


    public function store(Request $request)
    {
        try {
            $has_sinonimo = word_has_synonymous::create($request->all());
            return response()->json($has_sinonimo, Response::HTTP_CREATED);

        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al registrar : ' . $ex->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $has_sinonimo = word_has_synonymous::findOrFail($id);
            $has_sinonimo->update($request->all());
            return response()->json($has_sinonimo, Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al actualizar el operativo con id => ' . $id . " : " . $ex->getMessage()
            ], 400);
        }
    }


    public function destroy(Request $request, $id)
    {
        try {
            word_has_synonymous::find($id)->delete();
            return response()->json([], Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'error' => 'Hubo un error al eliminar el operativo con id => ' . $id . " : " . $ex->getMessage()
            ], 400);
        }
    }

}
