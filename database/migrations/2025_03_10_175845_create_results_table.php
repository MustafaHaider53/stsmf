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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('app_no');
            $table->string('uniName');
            $table->string('semester');
            $table->float('gpa');
            $table->float('cgpa');
            $table->string('resultFile');
            $table->string('feesFile');
            $table->string('remarks')->default('No remarks');
            $table->foreign('app_no')->references('appNo')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
