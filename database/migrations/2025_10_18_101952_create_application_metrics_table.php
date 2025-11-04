<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->dateTime('check_date');
            $table->decimal('uptime', 5, 2)->nullable();
            $table->decimal('response_time', 6, 3)->nullable();
            $table->enum('status', ['normal', 'lambat', 'down'])->default('normal');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_metrics');
    }
};
