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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->string('option_a');
            $table->string('option_a_sub');
            $table->string('option_b');
            $table->string('option_b_sub');
            $table->string('option_c');
            $table->string('option_c_sub');
            $table->string('option_d');
            $table->string('option_d_sub');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
