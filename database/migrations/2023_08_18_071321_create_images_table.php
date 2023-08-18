<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();

            $table->string('path');
            $table->string('url');
            $table->timestamps();

            $table->foreignId('product_id')
                ->nullable()
                ->index()
                ->constrained('products');
        });
    }


    public function down()
    {
        Schema::dropIfExists('images');
    }
}
