<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compartilhamento_documento', function (Blueprint $table) {
            $table->foreignUuid('documento_id')
                ->constrained('documentos')
                ->cascadeOnDelete();
            $table->foreignUuid('compartilhamento_id')
                ->constrained('compartilhamentos')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartilhamento_documento');
    }
};
