<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppliedStudentsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_students_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('country_id');
            $table->string('course_id');
            $table->string('agent_id');
            $table->string('file_status');
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
        Schema::dropIfExists('applied_students_files');
    }
}
