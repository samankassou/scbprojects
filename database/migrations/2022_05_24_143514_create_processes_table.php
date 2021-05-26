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
            $table->string('status');
            $table->string('created_by');
            $table->string('written_by');
            $table->string('validated_by');
            $table->string('approved_by');
            $table->date('creation_date');
            $table->date('written_date');
            $table->date('validation_date');
            $table->date('approved_date');
            $table->date('diffusion_date');
            $table->foreignId('entity_id')->constrained();
            $table->enum('state', ['Créé', 'Revu']);
            $table->text('reasons_for_creation')->nullable();
            $table->text('reasons_for_modification')->nullable();
            $table->text('appendices')->nullable();
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
