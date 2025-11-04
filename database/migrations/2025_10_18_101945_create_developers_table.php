<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->enum('developer_type', ['internal', 'vendor', 'freelance']);
            $table->string('contract_number', 100)->nullable();
            $table->date('contract_date')->nullable();
            $table->string('contact_email', 150)->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
