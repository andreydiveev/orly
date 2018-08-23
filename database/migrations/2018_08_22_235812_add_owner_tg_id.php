<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwnerTgId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
          ALTER TABLE `secrets`
            ADD COLUMN `owner_tg_id` INT(11) NOT NULL AFTER `label`;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
          ALTER TABLE `secrets`
            DROP COLUMN `owner_tg_id`;
        ");
    }
}
