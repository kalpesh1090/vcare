<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->integer('created_user_id')->index();
            $table->integer('itr_financial_year')->index();
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
            $table->string('aadhaar_number')->nullable();
            $table->string('email_address')->nullable();            
            $table->string('income_from_salary')->nullable();
            $table->string('income_from_house')->nullable();
            $table->string('share_transactions')->nullable();
            $table->string('income_from_consultancy')->nullable();
            $table->string('director_in_company')->nullable();
            $table->tinyInteger('current_status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->tinyInteger('is_delete')->default(0);
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
        Schema::dropIfExists('members');
    }
}
