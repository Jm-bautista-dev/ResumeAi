<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('template_slug')->default('modern-professional')->after('template_id');
            $table->unsignedTinyInteger('ai_score')->nullable()->after('template_slug');
            $table->unsignedTinyInteger('version')->default(1)->after('ai_score');
            $table->string('job_role')->nullable()->after('version');
            $table->string('industry')->nullable()->after('job_role');
        });
    }

    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn(['template_slug', 'ai_score', 'version', 'job_role', 'industry']);
        });
    }
};
