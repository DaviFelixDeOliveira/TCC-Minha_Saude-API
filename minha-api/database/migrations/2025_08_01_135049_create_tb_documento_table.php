<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_documento', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_hidden')->default(false);
            $table->string('caminho_arquivo', 255);
            $table->string('titulo', 255);
            $table->string('nome_paciente', 255)->nullable();
            $table->string('nome_medico', 255)->nullable();
            $table->string('tipo_documento', 120)->nullable();
            $table->date('data_documento')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();
            $table->uuid('fk_id_usuario');

            $table->foreign('fk_id_usuario')->references('id')->on('tb_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_documento');
    }
};
