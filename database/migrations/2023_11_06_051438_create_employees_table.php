<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();
            $table->date('date_of_birth');
            $table->foreignId('nationality_id')->constrained();
            $table->string('contact_number');
            $table->foreignId('geo_state_id')->constrained();
            $table->foreignId('geo_lga_id')->constrained();
            $table->foreignId('rank_id')->constrained();
            $table->string('step');
            $table->string('zip_code');
            $table->date('hire_date');
            $table->foreignId('gender_id')->constrained();
            $table->foreignId('command_id')->constrained();
            $table->foreignId('office_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('division_id')->constrained();
            $table->foreignId('unit_id')->constrained();
            $table->foreignId('designation_id')->constrained();
            $table->string('blood_group');
            $table->string('height');
            $table->string('genotype');
            $table->string('command')->nullable();
            $table->string('duty_post')->nullable();
            $table->string('maritalstatus_id');
            $table->string('next_of_kin');
            $table->string('nok_number');
            $table->string('nok_email');
            $table->string('permanent_home_address');
            $table->string('residential_address');
            $table->string('photograph')->nullable();
            $table->string('service_number')->nullable();
            $table->string('file_number')->nullable();
            $table->string('fingerprint')->nullable();
            $table->string('nin')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('exit_date')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
