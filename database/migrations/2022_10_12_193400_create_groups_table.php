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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->text('name');
            $table->longText('description');
            $table->boolean('is_public');
            $table->foreignId('user_id')
                ->constrained();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('group_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');

        Schema::table('projects', function (Blueprint $table) {
            $table->removeColumn('deleted_at');
        });
    }
};
