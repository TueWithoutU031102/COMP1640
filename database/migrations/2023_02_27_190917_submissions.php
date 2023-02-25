<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('submissions');
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->datetime('startDate');
            $table->datetime('dueDate');
            $table->unsignedBigInteger('author_id')->default(3);
            $table->foreign('author_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('submissions');
    }
};
