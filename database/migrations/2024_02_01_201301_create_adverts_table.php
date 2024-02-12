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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->index();
            $table->string('description')->nullable()->index();
            $table->string('link')->nullable()->index();
            $table->string('image')->nullable();
            $table->tinyInteger('block');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
