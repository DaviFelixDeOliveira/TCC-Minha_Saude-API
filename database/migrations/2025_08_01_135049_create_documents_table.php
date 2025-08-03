<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('is_hidden')->default(false); // era usado para esconder um documento enquanto ele era processado. Será removido em breve se tudo der certo
            $table->string('caminho_arquivo', 255);
            $table->string('titulo', 255);
            $table->string('nome_paciente', 255)->nullable();
            $table->string('nome_medico', 255)->nullable();
            $table->string('tipo_documento', 120)->nullable();
            $table->date('data_documento')->nullable();
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
