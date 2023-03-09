<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('emp', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('is_mang')->nullable();
            $table->string('mang_id')->nullable();
            $table->string('workshop_id')->nullable();
            $table->string('role_id');
            $table->boolean('active')->default(0);
            $table->string('created_by');
            $table->string('created_at');
            $table->string('updated_by')->nullable();
            $table->string('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp');
    }
}
