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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('starting_bid', 10, 2);
            $table->decimal('current_bid', 10, 2)->default(0);
            $table->decimal('reserve_price', 10, 2);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('auction_reference_id');
            $table->foreign('auction_reference_id')->references('id')->on('auction_references')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('auction_start')->nullable();
            $table->timestamp('auction_end')->nullable();
            $table->string('image_path')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
