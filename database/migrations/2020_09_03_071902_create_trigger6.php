<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('        
        CREATE TRIGGER `out_del_stok` BEFORE DELETE ON `outs`
        FOR EACH ROW BEGIN
        UPDATE items SET stok = stok+old.jumlah
        WHERE id = old.item_id;
        END
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger6');
    }
}
