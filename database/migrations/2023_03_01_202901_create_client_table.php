<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('client', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('name');
            $table->string('is_mang')->nullable();
            $table->string('mang_id')->nullable();
            $table->json('dep_id');
            $table->string('username')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('code')->unique();
            $table->string('role_id');
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('client');
    }
}
