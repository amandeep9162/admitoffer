<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agent_id');
            $table->string('student_unique_id');
            $table->string('lock_status');
            $table->string('title');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('lastName');
            $table->string('mobileNo');
            $table->string('dateOfBirth');
            $table->string('maritalStatus');
            $table->string('passportNo');
            $table->string('passportIssueDate');
            $table->string('passportExpiryDate');
            $table->string('phoneNo');
            $table->string('email');
            $table->string('status');
            $table->string('skypeId');
            $table->string('firstLanguage');
            $table->string('applingForCountry');
            $table->string('applingForLevel');
            $table->string('gender');
            $table->string('city_id');
            $table->string('country_id');
            $table->string('state_id');
            $table->string('address');
            $table->string('zipCode');
            $table->string('nationality');
            $table->string('countryOfBirth');
            $table->string('detail');
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
        Schema::dropIfExists('students');
    }
}
