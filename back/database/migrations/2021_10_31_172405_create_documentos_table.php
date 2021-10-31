<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned()->id();
            $table->string('nome');
            $table->unsignedBigInteger('tipo_documento_id');

            //vai criar documentos_tipo_documento_id_foreign
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documentos', function (Blueprint $table){
            $table->dropForeign('documentos_tipo_documento_id_foreign');
        });
        
        Schema::dropIfExists('documentos');
    }
}
