<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Exécuter les migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('code_iso', 2)->unique(); // Code ISO Alpha-2 (2 caractères)
            $table->string('indicatif_telephonique', 10)->nullable(); // Exemple : +33
            $table->string('monnaie', 3)->nullable(); // Code de la monnaie (ex. EUR)
            $table->string('nationalite')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
};
