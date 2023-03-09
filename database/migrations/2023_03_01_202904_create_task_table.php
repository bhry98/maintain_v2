<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('task', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('task_id')->nullable();
            $table->string('mach_id')->nullable();
            $table->string('cli_id');
            $table->string('order_time');
            $table->string('tittle');
            $table->string('details');
            $table->string('dep_id');
            $table->string('main_ok')->nullable();
            $table->string('main_ok_id')->nullable();
            $table->string('main_ok_time')->nullable();
            $table->string('workshop_id')->nullable();
            $table->string('emp_ok')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('emp_start_time')->nullable();
            $table->boolean('hold_time')->nullable();
            $table->string('emp_end_time')->nullable();
            $table->string('emp_done')->nullable();
            $table->string('emp_done_note')->nullable();
            $table->string('status')->default('1');
            $table->string('cli_done')->nullable();
            $table->boolean('is_close')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
}
