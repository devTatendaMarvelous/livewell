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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livestock_id')->constrained()->onDelete('cascade');
            $table->text('symptoms');
            $table->string('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('signs')->nullable();
            $table->text('prevention')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('vet_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('recorded_at')->nullable();
            $table->string('status')->default('PENDING'); // e.g., PENDING, COMPLETED
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
