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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experiment_id')->constrained();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->json('fields')->nullable();
            $table->json('notifications')->nullable();
        });

        Schema::table('actions', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('actions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
};
