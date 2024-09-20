<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemsAndCreateItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove image_path column from items table
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        // Create item_images table
        Schema::create('item_images', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->string('image_path'); // Path or URL to the image
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Add image_path column back to items table
        Schema::table('items', function (Blueprint $table) {
            $table->string('image_path')->nullable(); // Assuming you want it nullable
        });

        // Drop item_images table
        Schema::dropIfExists('item_images');
    }
}

