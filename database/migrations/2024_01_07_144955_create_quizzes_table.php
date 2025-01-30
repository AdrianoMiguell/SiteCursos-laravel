<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('alt1');
            $table->string('alt2');
            $table->string('alt3');
            $table->string('alt4');
            $table->string('alt5')->nullable();
            $table->smallInteger('altTrue');
            $table->smallInteger('order');
            $table->string('img')->nullable();
            $table->string('legend')->nullable();
            $table->foreignId('modulo_id')
                ->nullable()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('quizzes');
    }
};
