<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_security_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->date('audit_date');
            $table->string('auditor_name', 100);
            $table->enum('risk_level', ['rendah', 'sedang', 'tinggi']);
            $table->text('summary')->nullable();
            $table->text('recommendation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_security_audits');
    }
};
