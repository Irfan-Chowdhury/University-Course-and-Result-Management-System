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
			$table->unsignedBigInteger('department_id');
            $table->unsignedInteger('semester_id');
            $table->string('course_code');
            $table->string('course_name');
            $table->integer('credit');
            $table->text('description');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('semester_id')->references('id')->on('semesters');
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
