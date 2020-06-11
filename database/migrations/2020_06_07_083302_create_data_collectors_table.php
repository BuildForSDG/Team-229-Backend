<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCollectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function _up()
    {
        $schema = new Schema();
        $schema->create('data_collectors', function (Blueprint $table) {
            $table->unique('email');
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
        $schema = new Schema();
        $schema->dropIfExists('data_collectors');
    }
}
