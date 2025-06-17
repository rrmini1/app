<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('content');
            $table->date('start')->nullable();
            $table->date('finish')->nullable();
            $table->string('price');
            $table->boolean('pay_status')->default(false);
            $table->enum('work_status', ['on the go', 'completed'])->default('on the go');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');
    }
};
