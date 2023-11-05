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
