<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_analysis_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('score')->default(0);        // overall 0-100
            $table->unsignedTinyInteger('ats_score')->default(0);    // ATS compatibility
            $table->unsignedTinyInteger('grammar_score')->default(0);// Grammar/clarity
            $table->unsignedTinyInteger('content_score')->default(0);// Content quality
            $table->unsignedTinyInteger('keyword_score')->default(0);// Keyword density
            $table->json('suggestions')->nullable();    // actionable improvements
            $table->json('strengths')->nullable();      // good things
            $table->json('weaknesses')->nullable();     // bad things
            $table->string('recommended_template')->nullable();
            $table->json('suggested_roles')->nullable();
            $table->json('missing_skills')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_analysis_results');
    }
};
