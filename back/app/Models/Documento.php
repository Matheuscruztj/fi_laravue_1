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

    public function tipoDocumentos() {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id');
    }
}
