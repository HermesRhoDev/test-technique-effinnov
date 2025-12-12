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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference')->unique();
            $table->decimal('price', 10, 2); // Prix avec 2 décimales
            $table->integer('stock');
            $table->string('type'); // Pour stocker la valeur de l'enum
            $table->json('specifications')->nullable(); // Pour les attributs spécifiques (résistance, capacité, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
