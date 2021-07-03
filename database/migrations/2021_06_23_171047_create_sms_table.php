<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('sms_template_id')->nullable();
            $table->timestamp('sms_date')->nullable();
            $table->string('sms_to')->nullable();
            $table->string('sms_content',255)->nullable();
            $table->tinyInteger('sms_status')->default(0);
            $table->integer('job_id')->nullable();
            $table->timestamp('sms_sent_datetime')->nullable();
            $table->tinyInteger('sms_priority')->default(1);
            $table->timestamp('deleted_on')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->tinyInteger('is_delete')->default(0);


            


            $table->timestamps();
        });
    }

    /**`sms_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `sms_template_id` int DEFAULT NULL,
  `sms_date` datetime DEFAULT NULL,
  `sms_to` varchar(255) DEFAULT NULL,
  `sms_content` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `sms_status` enum('0','1') DEFAULT '0',
  `jobid` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `sms_sent_datetime` datetime DEFAULT NULL,
  `sms_priority` enum('1','2','3') NOT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `deleted_on` datetime DEFAULT NULL,
  `deleted_by` int DEFAULT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0'
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
