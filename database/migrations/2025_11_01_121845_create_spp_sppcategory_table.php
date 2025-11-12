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
        Schema::create('spp_sppcategory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sanphamphu_id')->constrained('sanphamphus')->cascadeOnDelete();
            $table->foreignId('spp_category_id')->constrained('spp_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_sppcategory');
    }
};
