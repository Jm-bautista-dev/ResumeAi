<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('resume_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('template_id')->default(1);
            $table->foreignId('theme_id')->nullable()->constrained()->onDelete('set null');
            $table->longText('config');
            $table->timestamp('published_at')->nullable();
            $table->string('github_repo')->nullable();
            $table->string('deployed_url')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
