<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeTaxReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_tax_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('created_user_id')->index();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('pan_number')->unique();
            $table->string('pan_file')->nullable();
            $table->string('father_name')->nullable();
            $table->integer('sex')->nullable();
            $table->string('block_no')->nullable();
            $table->string('name_of_Premises')->nullable();
            $table->string('street')->nullable();
            $table->string('locality')->nullable();
            $table->string('city')->nullable();
            $table->integer('pin')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('mobile')->nullable();
            $table->string('status')->nullable();
            $table->string('resident_status')->nullable();
            $table->string('resident_status_details')->nullable();
            $table->string('income_from_salary')->nullable();
            $table->string('income_from_house')->nullable();
            $table->string('share_transactions')->nullable();
            $table->string('income_from_consultancy')->nullable();
            $table->string('director_in_company')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('income_tax_returns');
    }
}
