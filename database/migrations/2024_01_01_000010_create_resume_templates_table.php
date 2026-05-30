<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category'); // modern, minimal, creative, technical, executive, gradient
            $table->text('description')->nullable();
            $table->string('thumbnail_color', 20)->default('#3B82F6'); // accent color for preview
            $table->boolean('is_ats_friendly')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('meta')->nullable(); // fonts, colors, tags
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_templates');
    }
};
