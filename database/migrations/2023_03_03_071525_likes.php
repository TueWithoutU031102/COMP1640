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
        //
        Schema::dropIfExists('likes');
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('idea_id');
            $table->foreign('idea_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('ideas');
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
        //
        Schema::dropIfExists('likes');
    }
};
