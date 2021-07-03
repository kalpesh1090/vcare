<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('template_id')->nullable();
            $table->timestamp('mail_date')->nullable();
            $table->string('email_to')->nullable();
            $table->string('content',255)->nullable();
            $table->string('subject',255)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('job_id')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->tinyInteger('priority')->default(1);
            $table->timestamp('deleted_on')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * 
     *  `id` int(11) NOT NULL,
  
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
