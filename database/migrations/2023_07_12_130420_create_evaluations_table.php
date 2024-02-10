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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 7);
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('faculty_id');
            $table->string('period_of_evaluation');
            $table->string('chairmanship_university')->nullable();
            $table->string('chairmanship_college')->nullable();
            $table->string('membership_university')->nullable();
            $table->string('membership_college')->nullable();
            $table->string('advisorship')->nullable();
            $table->string('oic')->nullable();
            $table->string('judge')->nullable();
            $table->string('resource')->nullable();
            $table->string('chairmanship_membership')->nullable();
            $table->string('facilication_on_going')->nullable();
            $table->string('facilication_regional')->nullable();
            $table->string('facilication_national')->nullable();
            $table->string('facilication_international')->nullable();
            $table->string('training_director_local')->nullable();
            $table->string('training_director_international')->nullable();
            $table->string('resource_speaker_local')->nullable();
            $table->string('resource_speaker_international')->nullable();
            $table->string('facilitator_moderator_local')->nullable();
            $table->string('facilitator_moderator_international')->nullable();
            $table->string('reactor_panel_member_local')->nullable();
            $table->string('reactor_panel_member_international')->nullable();
            $table->string('technical_assistance')->nullable();
            $table->string('judge_community')->nullable();
            $table->string('commencement_guest_speaker')->nullable();
            $table->string('coordinator_organizer_consultants')->nullable();
            $table->string('resource_person_lecturer')->nullable();
            $table->string('facilitator')->nullable();
            $table->string('member')->nullable();
            $table->string('name_of_faculty')->nullable();
            $table->string('status')->default('pending');
            $table->integer('total_points')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('evaluations');
    }
};
