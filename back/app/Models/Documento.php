<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = ['id', 'nome', 'tipo_documento_id'];

    protected $visible = ['id', 'nome'];

    public $timestamps = false;

    public function rulesAndFeedback() {
        $rules = [
            'nome' => 'required|min:2|max:255',
            'tipo_documento' => 'exists:tipo_documentos,id'
        ];
        $feedback = [
            'nome.required' => 'Nome requirido',
            'nome.min' => 'O nome precisa ter no minimo 2 caracteres',
            'nome.max' => 'O nome precisa ter no maximo 255',
            'tipo_documento.exists' => 'O tipo do documento precisa existir'
        ];

        $data = [];
        foreach ($rules as $key => $value) {
            $valuePartes = explode("|", $value);

            foreach($valuePartes as $parte){
                $atributo = explode(":", $parte);
                if(count($atributo) == 1) {
                    $data[] = [
                        'target' => $key,
                        'rule' => $atributo[0],
                        'feedback' => $feedback[$key.'.'.$atributo[0]]
                    ];
                }
                if(count($atributo) > 1) {
                    $data[] = [
                        'target' => $key,
                        'rule' => $parte,
                        'feedback' => $feedback[$key.'.'.$atributo[0]]
                    ];
                }
            }
        }

        return $data;
    }

    public function tipoDocumentos() {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
}
