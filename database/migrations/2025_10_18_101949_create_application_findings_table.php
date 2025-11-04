<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_findings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->enum('type', ['bug', 'vulnerability', 'hack', 'lainnya']);
            $table->enum('source', ['user', 'monitoring', 'audit', 'laporan_masyarakat']);
            $table->enum('severity', ['rendah', 'sedang', 'tinggi']);
            $table->text('description');
            $table->enum('status', ['open', 'in_progress', 'resolved'])->default('open');
            $table->text('follow_up_action')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_findings');
    }
};
