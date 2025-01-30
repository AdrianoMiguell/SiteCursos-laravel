<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER after_insert_curso
            AFTER INSERT ON cursos
            FOR EACH ROW
            BEGIN
                UPDATE categories
                SET amount = amount + 1
                WHERE id = NEW.category_id;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER after_delete_curso 
            AFTER DELETE ON cursos
            FOR EACH ROW
            BEGIN 
                UPDATE categories
                SET amount = amount - 1
                WHERE id = OLD.category_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_curso');
        DB::unprepared('DROP TRIGGER IF EXISTS after_delete_curso');
    }
};
