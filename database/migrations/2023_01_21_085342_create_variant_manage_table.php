<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantManageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_manage', function (Blueprint $table) {
            //$table->id();
            $table->uuid('id');
            $table->string('product_id');
            $table->string('variant_id');
            $table->json('variant_value');
            $table->json('variant_sku');
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
        Schema::dropIfExists('variant_manage');
    }
}
