<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('autorizacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('autorizador_id');
            $table->unsignedBigInteger('autorizado_id');
            $table->string('status')->default('pendente');
            $table->timestamps();
    
            $table->foreign('autorizador_id')->references('id')->on('users');
            $table->foreign('autorizado_id')->references('id')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorizacoes');
    }
};
