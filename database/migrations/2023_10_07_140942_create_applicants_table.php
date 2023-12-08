<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_birth');
            $table->string('reg_no');
            $table->string('nin');
            $table->enum('gender', ["Male","Female"]);
            $table->string('address');
            $table->string('city');
            $table->foreignId('geo_state_id')->constrained();
            $table->foreignId('geo_lga_id')->constrained();
            $table->string('zip_postal_code');
            $table->string('email_address');
            $table->string('phone_number');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('job_position_id')->constrained();
            $table->boolean('is_submitted')->default(false);
            $table->boolean('is_nin_verified')->default(false);
            $table->enum('status', ["Pending","Invitation For CBT", "Invite For Physical Verification", "Application Completed"]);
            $table->text('cover_letter')->nullable();
            $table->date('cbt_date')->nullable();
            $table->string('cbt_score')->nullable();
            $table->date('interview_date')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
