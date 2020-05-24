<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_tiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')
                  ->references('id')
                  ->on('reports')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->tinyInteger('type')
                  ->unsigned();

            $table->text('body')->nullable();

            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id')
                  ->references('id')
                  ->on('files')
                  ->onDelete('cascade');

            $table->text('query')->nullable();

            $table->tinyInteger('chart_type')
                  ->unsigned()
                  ->nullable();

            $table->json('options')->nullable();

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
        Schema::dropIfExists('report_tiles');
    }
}
