<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentWorkExperiancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_work_experiances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('organization');
            $table->string('designation');
            $table->string('fromDate');
            $table->string('toDate');
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
        Schema::dropIfExists('student_work_experiances');
    }
}
