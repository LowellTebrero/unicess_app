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
            $table->foreignId('evaluation_id')->constrained();
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
            $table->string('path');
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
