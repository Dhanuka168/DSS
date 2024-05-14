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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('disease_id')->index();
            $table->string('app_no',255);
            $table->string('patient_nic',20)->nullable();
            $table->string('patient_name',255)->nullable();
            $table->string('applicant_nic',20);
            $table->string('applicant_name',255);
            $table->string('phone',15);
            $table->string('city',45)->nullable();
            $table->boolean('delete_status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('disease_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
