<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->integer('min_quantity')->default(10);
            $table->string('unit')->default('unidade');
            $table->text('description')->nullable();
            $table->enum('type', [
                'medicamento',
                'equipamento_medico',
                'material_hospitalar',
                'limpeza',
                'escritorio',
                'alimentacao',
                'tecnologia',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
