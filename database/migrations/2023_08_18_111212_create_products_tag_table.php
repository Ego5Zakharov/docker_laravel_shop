<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTagTable extends Migration
{

    public function up()
    {
        Schema::create('products_tag', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('product_id')->index()->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->index()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products_tag');
    }
}
