<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_tb_usuario_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cpf', 14)->unique();
            $table->string('nome_completo', 255);
            $table->date('data_nascimento');
            $table->string('telefone', 20);
            $table->string('email', 255)->unique();
            $table->enum('metodo_autenticacao', ['google', 'email']);
            $table->string('google_id')->nullable();
            $table->enum('status_conta', ['ativa', 'excluida'])->default('ativa');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tb_usuario');
    }
};
