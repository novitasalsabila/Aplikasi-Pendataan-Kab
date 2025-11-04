<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('hostname', 150);
            $table->string('ip_address', 50);
            $table->string('os', 100);
            $table->string('location', 100)->nullable();
            $table->string('managed_by', 100)->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'maintenance'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
