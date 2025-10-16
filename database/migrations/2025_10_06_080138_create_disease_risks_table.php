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
        Schema::create('disease_risks', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('disease_name');
            $table->enum('risk_level', ['low', 'medium', 'high']);
            $table->string('source')->nullable();
            $table->date('forecast_date')->nullable();
            $table->boolean('published')->default(false)->after('forecast_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disease_risks');
    }
};
