<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('rank'); //ยศ
            $table->string('firstname'); //ชื่อ
            $table->string('lastname'); //สกุล
            $table->string('id_number')->unique(); //เลขประจำตัวประชาชน
            $table->string('soldier_number')->unique(); //เลขประจำตัวทหาร
            $table->string('corps'); //เหล่า
            $table->string('origin'); //กำเนิด
            $table->string('education'); //วุฒิการศึกษา
            $table->date('birthday'); //วันเกิด
            $table->date('rank_date'); //วันที่ได้รับยศปัจจุบัน
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
        Schema::dropIfExists('employee');
    }
}
