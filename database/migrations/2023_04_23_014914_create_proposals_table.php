<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 7);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('program_id');
            $table->string('colleges_name')->nullable();
            $table->dateTime('started_date')->nullable();
            $table->dateTime('finished_date')->nullable();
            $table->longtext('project_title');
            $table->string('authorize')->default('pending');
            $table->string('status')->default('active');
            $table->string('status_check_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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
        Schema::dropIfExists('proposals');
    }
};
