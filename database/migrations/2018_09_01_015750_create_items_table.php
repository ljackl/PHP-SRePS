<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id')->comment('Item ID');
            $table->string('name', 100)->comment('Item name');
            $table->string('description', 191)->nullable()->comment('Item description');
            $table->enum('category', ['one', 'two', 'three'])->comment('Item category');
            $table->integer('stock')->comment('Item quantity in stock');
            $table->decimal('cost', 5, 2)->comment('Item vender cost price');
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
        Schema::dropIfExists('items');
    }
}
