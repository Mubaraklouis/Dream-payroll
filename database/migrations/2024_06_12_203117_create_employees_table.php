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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable();
            $table->string("otp");
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone_number")->nullable();
            $table->string("address")->nullable();
            $table->date("birth_date")->nullable();
            $table->string("reg_number")->nullable();
            $table->string("job_title")->nullable();
            $table->string("department")->nullable();
            $table->string("base_location")->nullable();
            $table->string("contract_type")->nullable();
            $table->string("bank_name")->nullable();
            $table->string("bank_account_name")->nullable();
            $table->string("bank_account_number")->nullable();
            $table->boolean("has_dependents")->default(false);
            $table->text("dependents")->nullable();
            $table->integer("contract_duration")->nullable();
            $table->date("contract_start_date")->nullable();
            $table->string("status")->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
