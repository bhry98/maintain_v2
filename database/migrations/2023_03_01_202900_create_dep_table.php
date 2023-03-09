<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dep', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('mang_id')->nullable();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('level');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('dep');
    }
}
