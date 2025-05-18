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
        Schema::create('detail_commande', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('qte');
            $table->boolean('prix_vente_ht');
            $table->bigInteger('tva');
            $table->bigInteger('remise');
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('article');
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')->references('id')->on('commande');
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_commande');
    }
};
