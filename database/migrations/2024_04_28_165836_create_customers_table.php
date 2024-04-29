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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('dni')->primary();
            $table->foreignId('id_reg');
            $table->foreignId('id_com');
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('address');
            $table->string('date_reg');
            $table->enum('status', ['A', 'I', 'trash'])->default('A'); # Activo:Desactivo:Registro eliminado
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
