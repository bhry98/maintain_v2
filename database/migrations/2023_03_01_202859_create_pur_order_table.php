<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('pur_order', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('task_id');
            $table->string('note')->nullable();
            $table->string('main_ok')->nullable();
            $table->string('main_ok_id')->nullable();
            $table->string('main_ok_time')->nullable();
            $table->string('main_done')->nullable();
            $table->string('main_done_id')->nullable();
            $table->string('main_done_time')->nullable();
            $table->string('created_at');
            $table->string('created_by');
            $table->string('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pur_order');
    }
}
