<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained('processes');
            $table->string('name');
            $table->string('version');
            $table->string('type');
            $table->string('status');
            $table->string('created_by');
            $table->string('written_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('creation_date');
            $table->date('writing_date')->nullable();
            $table->date('verification_date')->nullable();
            $table->date('date_of_approval')->nullable();
            $table->date('broadcasting_date')->nullable();
            $table->enum('state', ['Créé', 'Revu']);
            $table->text('reasons_for_creation')->nullable();
            $table->text('reasons_for_modification')->nullable();
            $table->text('appendices')->nullable();
            $table->text('modifications')->nullable();
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
        Schema::dropIfExists('process_versions');
    }
}
