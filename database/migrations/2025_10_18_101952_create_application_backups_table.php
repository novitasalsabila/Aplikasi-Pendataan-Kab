<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_backups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->dateTime('backup_date');
            $table->enum('backup_type', ['harian', 'mingguan', 'bulanan', 'manual']);
            $table->string('storage_location', 255);
            $table->enum('verified_st', ['ya', 'tidak'])->default('tidak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_backups');
    }
};
