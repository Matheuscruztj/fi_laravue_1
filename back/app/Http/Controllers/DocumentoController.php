<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Response\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all()->toArray();
        return JsonResponse::success('Listagem dos documentos', $documentos);
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
    public function store(Request $request)
    {
        try{
            $regras = [
                'nome' => 'required|min:2|max:255',
                'tipo_documento' => 'exists:tipo_documentos,id'
            ];
            $feedback = [
                'nome.required' => 'Nome requirido',
                'nome.min' => 'O nome precisa ter no minimo 2 caracteres',
                'nome.max' => 'O nome precisa ter no maximo 255',
                'tipo_documento.exists' => 'O tipo do documento precisa existir'
            ];

            $validator = $request->validate($regras, $feedback);

            $documento = new Documento();

            $documento->nome = $request->nome;
            $documento->tipo_documento_id = $request->tipo_documento;

            $documento->save();

            return JsonResponse::success('Documento salvo com sucesso', [$documento->toArray()]);
        }catch(Exception $e){
            if(isset($e->validator->customMessages)){
                foreach($e->validator->customMessages as $key => $value){
                    $erros[] = $value;
                }
                return JsonResponse::error('Corrija os seguintes erros e tente novamente', [$erros]);
            }

            return JsonResponse::error('Problema durante o processo', [$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Integer $id
     */
    public function show($id)
    {
        try{
            $documento = new Documento();
            $documento = $documento->find($id) ? $documento->find($id)->first()->toArray() : null;
    
            if(!$documento){
                return JsonResponse::error2(404, 'Documento não encontrado', []);
            }

            return JsonResponse::success('Documento encontrado com sucesso', $documento);
        }catch(Exception $e){
            return JsonResponse::error('Problema durante a procura', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $target = null;
        $feedback = null;

        try{
            $documento = Documento::find($id) ?  Documento::find($id)->first() : null;
    
            if(!$documento){
                return JsonResponse::error('documento não encontrado', []);
            }

            $rulesAndFeedback = Documento::rulesAndFeedback();
            foreach($rulesAndFeedback as $obj){
                $target = $obj['target'];
                $feedback = $obj['feedback'];

                $request->validate([
                    $obj['target'] => $obj['rule']
                ], [$feedback]);
            }

            $updateNecessary = false;
            if($request->nome && $request->nome != $documento->nome)
                $documento->nome = $request->nome;
                $updateNecessary = true;
            
            if($request->tipo_documento && $request->tipo_documento != $documento->tipo_documento_id)
                $documento->tipo_documento_id = $request->tipo_documento;
                $updateNecessary = true;
            
            if($updateNecessary)
                return JsonResponse::warning('Atualização nao é necessária', []);
            
            $documento->save();

            return JsonResponse::success('Documento alterado com sucesso', [$documento->toArray()]);
        }catch(Exception $e){
            if(isset($e->validator->customMessages)){
                $erros[] = [
                    'coluna' => $target,
                    'regra' => $feedback,
                ];
                return JsonResponse::error('Corrija os seguintes erros e tente novamente', $erros);
            }

            return JsonResponse::error('Problema durante o processo', [$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        try{
            $documento = Documento::find($id) ?  Documento::find($id)->first() : null;
    
            if(!$documento){
                return JsonResponse::error('Documento não encontrado', []);
            }

            $documento->delete();
            return JsonResponse::success('Documento removido com sucesso!', []);    
        }catch(Exception $e){
            return JsonResponse::error('Problema durante o processo', [$e->getMessage()]);
        }
    }
}
