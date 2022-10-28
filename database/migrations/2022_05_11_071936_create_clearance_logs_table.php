<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_logs', function (Blueprint $table) {
            $table->id();
            $table->string('control_number')->nullable();
            $table->integer('student_id');
            $table->integer('school_year')->nullable();
            $table->string('sem')->nullable();
            $table->integer('assignee_id')->nullable();
            $table->integer('message')->nullable();
            $table->integer('clearance_status')->nullable();
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
        Schema::dropIfExists('clearance_logs');
    }
}
