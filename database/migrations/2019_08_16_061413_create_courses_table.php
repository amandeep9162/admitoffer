<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('college_id');
            $table->string('name');
            $table->string('inserted_by');
            $table->string('subject');
            $table->string('description');
            $table->string('workexp');
            $table->string('programTitle_id');
            $table->string('internship');
            $table->string('highlyCompetitive');
            $table->string('academicRequirement');
            $table->string('program_length');
            $table->string('intake');
            $table->string('qualification');
            $table->string('course_level');
            $table->string('tution_fee');
            $table->string('application_fee');
            $table->string('isIlets');
            $table->string('ilets_score');
            $table->string('english_score');
            $table->string('program_status');
            $table->string('program_delivery');
            $table->string('scholarship');
            $table->string('isMath');
            $table->string('mathScore');
            $table->string('total_commission');
            $table->string('agent_commission');
            $table->string('admission_overseasCut');
            $table->string('processing_time');
            $table->string('note');
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
        Schema::dropIfExists('courses');
    }
}
