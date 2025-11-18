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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_name_for_emails')->nullable();
            $table->string('email')->nullable();
            $table->string('email_status')->nullable();
            $table->string('departments')->nullable();
            $table->string('contact_owner')->nullable();
            $table->string('corporate_phone')->nullable();
            $table->integer('employee_count')->nullable();
            $table->string('industry')->nullable();
            $table->text('keywords')->nullable();
            $table->string('person_linkedin_url')->nullable();
            $table->string('website')->nullable();
            $table->string('company_linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('technologies')->nullable();
            $table->string('annual_revenue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
