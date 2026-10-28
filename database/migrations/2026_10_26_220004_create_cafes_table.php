<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            //1-op-veel. een categorie heeft veel cafes
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('city');                 //filter locatie
            $table->unsignedTinyInteger('price_level'); //prijs range
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
