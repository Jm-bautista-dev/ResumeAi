<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('primary_color')->default('#3B82F6');
            $table->string('secondary_color')->default('#1E293B');
            $table->string('accent_color')->default('#EC4899');
            $table->string('font_family')->default('Inter');
            $table->string('layout_style')->default('modern');
            $table->string('background_effect')->default('gradient');
            $table->string('card_style')->default('glassmorphism');
            $table->longText('config');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
