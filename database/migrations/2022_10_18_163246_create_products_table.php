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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('mohinhnuoi')->nullable();
            $table->string('thucan')->nullable();
            $table->string('dokhonuoi')->nullable();
            $table->string('giatrikinhte')->nullable();
            $table->string('thoigiannuoi')->nullable();
            $table->string('phuhop')->nullable();
            $table->string('slug')->unique();
            $table->longText('body');
            $table->enum('status', ['published', 'scheduled', 'pending'])->default('pending');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('scheduled_for')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_min')->nullable();
            $table->integer('price_max')->nullable();
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
