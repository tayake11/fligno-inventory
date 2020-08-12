<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipmentlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipment_id');
            $table->string('brand');
            $table->string('model');
            $table->string('serial');
            $table->string('specification');
            $table->unsignedBigInteger('equipment_type_id');
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
        Schema::dropIfExists('equipmentlists');
    }
}
