<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('source_site', 20);
            $table->string('source_id', 100);
            $table->string('title');
            $table->string('illegal');
            $table->string('place', 100);
            $table->string('license_plate', 100);
            $table->integer('year');
            $table->text('description');
            $table->index(['source_site', 'source_id']);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');
    }
}
