<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop legacy option columns from questions
        Schema::table('questions', function (Blueprint $table) {
            if (Schema::hasColumn('questions', 'option_a')) $table->dropColumn('option_a');
            if (Schema::hasColumn('questions', 'option_a_sub')) $table->dropColumn('option_a_sub');
            if (Schema::hasColumn('questions', 'option_b')) $table->dropColumn('option_b');
            if (Schema::hasColumn('questions', 'option_b_sub')) $table->dropColumn('option_b_sub');
            if (Schema::hasColumn('questions', 'option_c')) $table->dropColumn('option_c');
            if (Schema::hasColumn('questions', 'option_c_sub')) $table->dropColumn('option_c_sub');
            if (Schema::hasColumn('questions', 'option_d')) $table->dropColumn('option_d');
            if (Schema::hasColumn('questions', 'option_d_sub')) $table->dropColumn('option_d_sub');
        });

        // Drop legacy answer columns (no longer used)
        Schema::table('answers', function (Blueprint $table) {
            if (Schema::hasColumn('answers', 'chosen_option')) $table->dropColumn('chosen_option');
            if (Schema::hasColumn('answers', 'sub')) $table->dropColumn('sub');
        });
    }

    public function down(): void
    {
        // Restore legacy columns for rollback safety
        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'option_a')) $table->string('option_a')->nullable();
            if (!Schema::hasColumn('questions', 'option_a_sub')) $table->string('option_a_sub')->nullable();
            if (!Schema::hasColumn('questions', 'option_b')) $table->string('option_b')->nullable();
            if (!Schema::hasColumn('questions', 'option_b_sub')) $table->string('option_b_sub')->nullable();
            if (!Schema::hasColumn('questions', 'option_c')) $table->string('option_c')->nullable();
            if (!Schema::hasColumn('questions', 'option_c_sub')) $table->string('option_c_sub')->nullable();
            if (!Schema::hasColumn('questions', 'option_d')) $table->string('option_d')->nullable();
            if (!Schema::hasColumn('questions', 'option_d_sub')) $table->string('option_d_sub')->nullable();
        });

        Schema::table('answers', function (Blueprint $table) {
            if (!Schema::hasColumn('answers', 'chosen_option')) $table->string('chosen_option')->nullable();
            if (!Schema::hasColumn('answers', 'sub')) $table->string('sub')->nullable();
        });
    }
};

