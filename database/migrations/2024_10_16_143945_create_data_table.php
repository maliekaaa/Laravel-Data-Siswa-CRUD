<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('nis');
            $table->string('jurusan');
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data');
    }
};
