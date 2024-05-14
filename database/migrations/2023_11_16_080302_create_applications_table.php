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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('disease_id')->index();
            $table->string('application_no',255);
            $table->string('patient_nic',20);
            $table->string('patient_name',255);
            $table->string('patient_address1',500);
            $table->string('patient_address2',500);
            $table->string('patient_phone',15);
            $table->string('patient_remarks', 700)->nullable(); 
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
        Schema::dropIfExists('applications');
    }
};
