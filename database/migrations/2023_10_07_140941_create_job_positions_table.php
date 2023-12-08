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

        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name');
            $table->string('department');
            $table->string('job_description');
            $table->text('required_qualifications');
            $table->string('applicant_deadline');
            $table->enum('status', ["open","close"]);
            $table->dateTime('deleted_at');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_positions');
    }
};
