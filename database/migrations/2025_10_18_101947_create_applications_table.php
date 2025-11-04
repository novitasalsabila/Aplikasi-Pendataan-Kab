<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->enum('category', ['web', 'mobile', 'desktop']);
            $table->enum('data_sensitivity', ['publik', 'internal', 'rahasia']);
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->foreignId('developer_id')->nullable()->constrained('developers')->nullOnDelete();
            $table->foreignId('server_id')->nullable()->constrained('servers')->nullOnDelete();
            $table->enum('status', ['aktif', 'nonaktif', 'maintenance'])->default('aktif');
            $table->date('last_update')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
