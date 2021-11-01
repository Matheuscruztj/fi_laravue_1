<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\TipoDocumento;
use Exception;

class TesteController extends Controller {
    public function ola3() {
        return 'ola3';
    }
    public function ola(){
        try{
            $tip = new TipoDocumento();
            $tip = $tip->find(1) ? $tip->find(1)->with('documentos')->first() : null;

            if(!$tip){
                return 'nao existe';
            }

            $doc = $tip->find(1)->with('documentos:id,nome')->first();
            dd($doc);
        }catch(Exception $e){
            dd($e);
        }
    }

    //with (com filtro) funcionando -> many to one
    public function ola2(){
        try{
            $doc = new Documento();
            $doc = $doc->find(1) ? $doc->find(1)->with('tipoDocumentos:id')->first() : null;

            if(!$doc){
                return 'nao existe';
            }

            dd($doc);
        }catch(Exception $e){
            dd($e);
        }
    }
}
