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
        Schema::create('proposal_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->unsignedBigInteger('leader_member_type')->nullable();
            $table->string('member_type')->nullable();
            $table->string('location_id')->nullable();
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('leader_member_type')->references('id')->on('ceso_roles')->onDelete('cascade');
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
        Schema::dropIfExists('proposal_members');
    }
};
