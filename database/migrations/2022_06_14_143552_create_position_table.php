<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('shortname'); //ชื่อตำแหน่ง
            $table->string('name'); //ชื่อย่อตำแหน่ง
            $table->string('number'); //เลขที่ตำแหน่ง
            $table->string('expert'); //เลข ชกท.
            $table->string('rate'); //อัตรา
            $table->string('corps'); //จำกัดเหล่า
            $table->boolean('status'); //อัตราเปิด/ปิด
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee');
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
        Schema::dropIfExists('position');
    }
}
