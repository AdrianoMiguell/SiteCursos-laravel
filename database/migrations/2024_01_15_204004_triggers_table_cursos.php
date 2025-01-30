<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared(
            '
                CREATE TRIGGER after_insert_matricula
                AFTER INSERT ON matriculas
                FOR EACH ROW 
                BEGIN
                    UPDATE cursos
                    SET stars = stars + 1
                    WHERE id = NEW.curso_id;
                END;
            '
        );

        DB::unprepared(
            '
                CREATE TRIGGER after_delete_matricula
                AFTER DELETE ON matriculas
                FOR EACH ROW 
                BEGIN
                    UPDATE cursos
                    SET stars = stars - 1
                    WHERE id = OLD.curso_id;
                END;
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_matricula');
        DB::unprepared('DROP TRIGGER IF EXISTS after_delete_matricula');
    }
};
