<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->enum('type', [
                'personal_info',
                'summary',
                'skills',
                'experience',
                'education',
                'projects',
                'certifications',
                'social_links',
                'awards',
                'languages'
            ]);
            $table->string('title');
            $table->integer('order')->default(0);
            $table->longText('content');
            $table->timestamps();

            $table->index('resume_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_sections');
    }
};
