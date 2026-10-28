<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            //wie de review schreef (alleen deze user mag hem wijzigen)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cafe_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating'); //1 t/m 5 sterren
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
