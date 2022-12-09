<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::connection('mongodb')->create('records', function ($collection) {
            $collection->index('experiment_id');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::connection('mongodb')->dropIfExists('records');
    }
};
