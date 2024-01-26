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
        Schema::create('temporary_evaluation_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('chairmanship_wide')->nullable();
            $table->string('chairmanship_wide_file')->nullable();
            $table->string('chairmanship_unit')->nullable();
            $table->string('chairmanship_unit_file')->nullable();
            $table->string('membership_wide')->nullable();
            $table->string('membership_wide_file')->nullable();
            $table->string('membership_unit')->nullable();
            $table->string('membership_unit_file')->nullable();
            $table->string('advisorships')->nullable();
            $table->string('advisorships_file')->nullable();
            $table->string('oics')->nullable();
            $table->string('oics_file')->nullable();
            $table->string('judges')->nullable();
            $table->string('judges_file')->nullable();
            $table->string('resource_generation')->nullable();
            $table->string('resource_generation_file')->nullable();
            $table->string('chairmanship')->nullable();
            $table->string('chairmanship_file')->nullable();
            $table->string('facilitation_ongoing')->nullable();
            $table->string('facilitation_ongoing_file')->nullable();
            $table->string('facilitation_regional')->nullable();
            $table->string('facilitation_regional_file')->nullable();
            $table->string('facilitation_national')->nullable();
            $table->string('facilitation_national_file')->nullable();
            $table->string('facilitation_international')->nullable();
            $table->string('facilitation_international_file')->nullable();
            $table->string('training_director_local')->nullable();
            $table->string('training_director_local_file')->nullable();
            $table->string('training_director_international')->nullable();
            $table->string('training_director_international_file')->nullable();
            $table->string('resource_speaker_local')->nullable();
            $table->string('resource_speaker_local_file')->nullable();
            $table->string('resource_speaker_international')->nullable();
            $table->string('resource_speaker_international_file')->nullable();
            $table->string('facilitator_moderator_local')->nullable();
            $table->string('facilitator_moderator_local_file')->nullable();
            $table->string('facilitator_moderator_international')->nullable();
            $table->string('facilitator_moderator_international_file')->nullable();
            $table->string('reactor_panel_member_local')->nullable();
            $table->string('reactor_panel_member_local_file')->nullable();
            $table->string('reactor_panel_member_international')->nullable();
            $table->string('reactor_panel_member_international_file')->nullable();
            $table->string('technical_assistance')->nullable();
            $table->string('technical_assistance_file')->nullable();
            $table->string('judge_community')->nullable();
            $table->string('judge_community_file')->nullable();
            $table->string('commencement_guest_speaker')->nullable();
            $table->string('commencement_guest_speaker_file')->nullable();
            $table->string('coordinator_organizer_consultants')->nullable();
            $table->string('coordinator_organizer_consultants_file')->nullable();
            $table->string('facilitator')->nullable();
            $table->string('facilitator_file')->nullable();
            $table->string('member')->nullable();
            $table->string('member_file')->nullable();
            $table->string('resource_person_lecturer')->nullable();
            $table->string('resource_person_lecturer_file')->nullable();
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
        Schema::dropIfExists('temporary_evaluation_files');
    }
};