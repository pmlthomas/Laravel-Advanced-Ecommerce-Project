<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('sub_sub_category_id');
            $table->string('product_name_fr');
            $table->string('product_name_en');
            $table->string('product_slug_fr');
            $table->string('product_slug_en');
            $table->string('product_code');
            $table->string('product_quantity');
            $table->string('product_tags_fr');
            $table->string('product_tags_en');
            $table->string('product_size_fr')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_color_fr');
            $table->string('product_color_en');
            $table->string('product_selling_price');
            $table->string('product_discount_price')->nullable();
            $table->string('product_short_desc_fr');
            $table->string('product_short_desc_en');
            $table->string('product_long_desc_fr');
            $table->string('product_long_desc_en');
            $table->string('product_image');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
