<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('method_id')->constrained();
            $table->string('version');
            $table->string('type');
            $table->string('reference');
            $table->string('status');
            $table->string('created_by');
            $table->string('written_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('creation_date');
            $table->date('written_date')->nullable();
            $table->date('verification_date')->nullable();
            $table->date('date_of_approval')->nullable();
            $table->date('diffusion_date')->nullable();
            $table->enum('state', ['Créé', 'Revu']);
            $table->text('reasons_for_creation')->nullable();
            $table->text('reasons_for_modification')->nullable();
            $table->text('appendices')->nullable();
            $table->text('modifications')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('processes');
    }
}
