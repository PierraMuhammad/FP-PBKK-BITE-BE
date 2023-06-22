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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id");
            $table->integer("quantity");
            $table->integer("total");
            $table->string("status");
            $table->timestamps();

            // $table->id();
            // $table->integer("user_id");
            // $table->string("status");
            // $table->integer("total")->nullable();
            // $table->json("product");
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
