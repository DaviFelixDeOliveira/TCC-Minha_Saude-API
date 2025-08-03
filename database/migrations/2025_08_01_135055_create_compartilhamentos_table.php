<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compartilhamentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('codigo', 8)->unique();
            $table->timestamp('data_primeiro_uso')->nullable();
            $table->boolean('expirado')->default(false);
            $table->timestamps();
            $table->foreignUuid('user_id')->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compartilhamentos');
    }
};

