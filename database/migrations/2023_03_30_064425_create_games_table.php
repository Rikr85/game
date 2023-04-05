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
      
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string(column:'user');          //Usuario
            $table->integer(column:'age');          //Edad
            $table->integer(column:'tries');        //Intentos
            $table->integer(column:'time');         //Tiempo
            $table->string(column:'secret');
            $table->boolean(column:'status');       //Ganado(true)/Perdido(false)
            $table->timestamps();
        });
      
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
