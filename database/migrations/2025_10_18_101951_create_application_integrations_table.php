<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_integrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_app_id')->constrained('applications')->cascadeOnDelete();
            $table->foreignId('target_app_id')->constrained('applications')->cascadeOnDelete();
            $table->enum('type', ['API', 'Database', 'File', 'Manual']);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_integrations');
    }
};
