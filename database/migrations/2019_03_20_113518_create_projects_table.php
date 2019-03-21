<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('owner_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->foreign('owner_id')
               ->references('id')
               ->on('users')
               ->onDelete('cascade');
        });
    }
}
