<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('reference')->nullable();
            $table->string('name');
            $table->string('description');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('sponsor');
            $table->enum('initiative', ['groupe', 'local']);
            $table->string('amoa');
            $table->string('moe');
            $table->string('manager');
            $table->integer('cost');
            $table->enum('status', ['en stand-by', 'en cours', 'inachevé', 'terminé']);
            $table->unsignedInteger('progress');
            $table->text('benefits');
            $table->text('documentation')->nullable();
            $table->text('bills')->nullable();
            $table->softDeletes();
            $table->integer('saved_by')->nullable();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
