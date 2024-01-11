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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('img')->nullable();
            $table->string('desc', 2500);
            $table->mediumInteger('duration');
            $table->integer('real_price');
            $table->smallInteger('promotion');
            $table->integer('promotion_price');
            $table->boolean('visible');
            $table->date('release_date');
            $table->foreignId('category_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        // name, description, duration, modulos, price, promotion
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
