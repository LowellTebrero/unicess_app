<?php

use App\Models\Faculty;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('suffix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('birth_date')->nullable();
            $table->longText('province')->nullable();
            $table->longText('city')->nullable();
            $table->longText('barangay')->nullable();
            $table->longText('address')->nullable();
            $table->longText('zipcode')->nullable();
            $table->string('authorize')->default('pending');
            $table->string('password')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('google_access_token')->nullable();
            $table->text('google_refresh_token')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('last_logged_in')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
