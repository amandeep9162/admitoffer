<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnglishTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_english_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('testName');
            $table->string('dateOfTest');
            $table->string('reading');
            $table->string('writing');
            $table->string('speaking');
            $table->string('listening');
            $table->string('overAll');
            $table->string('totalScore');
            $table->string('student_id');
            $table->softDeletes();
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
        Schema::dropIfExists('student_english_tests');
    }
}
