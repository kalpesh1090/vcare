<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('income_tax_returns_id')->index();
            $table->string('document_name')->nullable(); 
            $table->text('document_path')->nullable(); 
            $table->integer('created_by')->nullable();
            $table->softDeletes();
            $table->foreign('income_tax_returns_id')->references('id')->on('income_tax_returns')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('documents');
    }
}
