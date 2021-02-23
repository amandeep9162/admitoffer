<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('qualificationName');
            $table->string('subject');
            $table->string('instituteName');
            $table->string('country_id');
            $table->string('state_id');
            $table->string('city_id');
            $table->string('from');
            $table->string('to');
            $table->string('total');
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
        Schema::dropIfExists('student_qualifications');
    }
}
