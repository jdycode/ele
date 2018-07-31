<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户名');
            $table->string('tel')->comment('电话');
            $table->string('provence')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('区');
            $table->string('detail_address')->comment('默认地址');
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
        Schema::dropIfExists('addresse');
    }
}
