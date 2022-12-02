<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_settings', function (Blueprint $table) {
            $table->id();
            $table->json('setting');
            $table->timestamps();
        });

        Schema::table('experiments', function (Blueprint $table) {
            $table->foreignId('setting_id')
                ->nullable()
                ->constrained('experiment_settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiment_settings');

        Schema::table('group_members', function (Blueprint $table) {
            $table->removeColumn('setting_id');
        });
    }
};
