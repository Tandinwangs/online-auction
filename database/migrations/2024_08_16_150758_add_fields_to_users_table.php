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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('cid');
            $table->string('dzongcode')->nullable()->after('phone_number');
            $table->string('gewocode')->nullable()->after('dzongcode');
            $table->string('villcode')->nullable()->after('gewocode');

            // Set up the foreign key constraints
            $table->foreign('dzongcode')->references('dzongcode')->on('dzongkhags')->onDelete('cascade');
            $table->foreign('gewocode')->references('gewogcode')->on('gewogs')->onDelete('cascade');
            $table->foreign('villcode')->references('villcode')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['dzongcode']);
            $table->dropForeign(['gewocode']);
            $table->dropForeign(['villcode']);

            // Drop the columns
            $table->dropColumn('phone_number');
            $table->dropColumn('dzongcode');
            $table->dropColumn('gewocode');
            $table->dropColumn('villcode');
        });
    }
};
