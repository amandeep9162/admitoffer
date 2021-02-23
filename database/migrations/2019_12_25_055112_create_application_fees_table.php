<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('attachment_id');
            $table->string('application_id');
            $table->string('tution_fee');
            $table->string('total_comission');
            $table->string('agent_comission');
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
        Schema::dropIfExists('application_fees');
    }
}
