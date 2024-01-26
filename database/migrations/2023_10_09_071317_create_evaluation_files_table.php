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
        Schema::create('evaluation_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id');
            $table->string('chairmanship_wide')->nullable();
            $table->string('membership_unit')->nullable();
            $table->string('membership_wide')->nullable();
            $table->string('chairmanship_unit')->nullable();
            $table->string('advisorships')->nullable();
            $table->string('oics')->nullable();
            $table->string('judges')->nullable();
            $table->string('resource_generation')->nullable();
            $table->string('chairmanship')->nullable();
            $table->string('facilitation_ongoing')->nullable();
            $table->string('facilitation_regional')->nullable();
            $table->string('facilitation_national')->nullable();
            $table->string('facilitation_international')->nullable();
            $table->string('training_director_locals')->nullable();
            $table->string('training_director_internationals')->nullable();
            $table->string('resource_speaker_locals')->nullable();
            $table->string('resource_speaker_internationals')->nullable();
            $table->string('facilitator_moderator_locals')->nullable();
            $table->string('facilitator_moderator_internationals')->nullable();
            $table->string('reactor_panel_member_locals')->nullable();
            $table->string('reactor_panel_member_internationals')->nullable();
            $table->string('technical_assistances')->nullable();
            $table->string('judge_communitys')->nullable();
            $table->string('commencement_guest_speakers')->nullable();
            $table->string('coordinator_organizer_consultantses')->nullable();
            $table->string('facilitators')->nullable();
            $table->string('members')->nullable();
            $table->string('resource_person_lecturers')->nullable();
            $table->string('path');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');
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
        Schema::dropIfExists('evaluation_files');
    }
};