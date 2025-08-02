<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_exportacao', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('caminho_arquivo');
            $table->timestamp('created_at')->useCurrent();

            $table->uuid('fk_id_usuario');
            $table->foreign('fk_id_usuario')->references('id')->on('tb_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_exportacao');
    }
};
