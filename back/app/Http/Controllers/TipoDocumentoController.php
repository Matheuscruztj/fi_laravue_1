<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\TipoDocumento;
use App\Response\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function index()
    {
        $tipos = TipoDocumento::with('documentos')->get()->toArray();
        return JsonResponse::success('Listagem dos tipos de documentos', $tipos);
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
                'nome' => 'required|min:2|max:255'
            ];
            $feedback = [
                'nome.required' => 'Nome requirido',
                'nome.min' => 'O nome precisa ter no minimo 2 caracteres',
                'nome.max' => 'O nome precisa ter no maximo 255'
            ];

            $request->validate($regras, $feedback);

            $tipo = new TipoDocumento();

            $tipo->nome = $request->nome;
            $tipo->save();

            return JsonResponse::success('Tipo salvo com sucesso', [$tipo->toArray()]);
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
            $tipo = new TipoDocumento();
            $tipo = $tipo->find($id) ? $tipo->find($id)->first()->toArray() : null;
    
            if(!$tipo){
                return JsonResponse::error('Tipo não encontrado', []);
            }

            return JsonResponse::success('Listagem dos tipos de documentos', $tipo);
        }catch(Exception $e){
            return JsonResponse::error('Problema durante a procura', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_documento $tipo_documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Integer $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try{
            $tipo = new TipoDocumento();
            $tipo = $tipo->find($id) ? $tipo->find($id)->first() : null;
    
            if(!$tipo){
                return JsonResponse::error('Tipo não encontrado', []);
            }

            $regras = [
                'nome' => 'required|min:2|max:255'
            ];
            $feedback = [
                'nome.required' => 'Nome requirido',
                'nome.min' => 'O nome precisa ter no minimo 2 caracteres',
                'nome.max' => 'O nome precisa ter no maximo 255'
            ];

            $request->validate($regras, $feedback);

            $tipo->nome = $request->nome;

            $tipo->save();

            return JsonResponse::success('Tipo alterado com sucesso', [$tipo->toArray()]);
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
     * Remove the specified resource from storage.
     *
     * @param Integer $id
     */
    public function destroy($id)
    {
        try{
            $tipo = new TipoDocumento();
            $tipo = $tipo->find($id) ? $tipo->with('documentos')->where('id', $id)->first() : null;
    
            if(!$tipo){
                return JsonResponse::error('Tipo não encontrado', []);
            }

            if($tipo->documentos()->first() != null) {
                $data = [];
                foreach($tipo->documentos()->get() as $obj){
                    $data[] = [
                        'documento_id' => $obj->id,
                        'documento_nome' => $obj->nome
                    ];
                }
                return JsonResponse::warning('Alterar os documentos listados, para que se possa remover o tipo de documento', [$data]);    
            }
            
            $tipo->delete();
            return JsonResponse::success('Tipo de documento removido com sucesso!', []);    
        }catch(Exception $e){
            return JsonResponse::error('Problema durante o processo', [$e->getMessage()]);
        }
    }
}
