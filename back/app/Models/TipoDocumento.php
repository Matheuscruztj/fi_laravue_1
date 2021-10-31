<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documentos';
    
    public $timestamps = false;
    
    protected $fillable = ['id', 'nome'];

    // public function rules(){
    //     return [
    //         'modelo_id' => 'exists:modelos,id',
    //         'placa' => 'required',
    //         'disponivel' => 'required',
    //         'km' => 'required',
    //     ];
    // }

    public function documentos() {
        return $this->hasMany(Documento::class, 'tipo_documento_id', 'id');
    }
}
