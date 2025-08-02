<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_compartilhamento', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('codigo', 8)->unique();
            $table->timestamp('data_primeiro_uso')->nullable();
            $table->boolean('expirado')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('deleted_at')->nullable();
            $table->uuid('fk_id_usuario');

            $table->foreign('fk_id_usuario')->references('id')->on('tb_usuario');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_compartilhamento');
    }
};

