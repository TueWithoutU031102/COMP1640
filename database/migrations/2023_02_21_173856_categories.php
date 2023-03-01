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
        Schema::dropIfExists('categories');
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
<<<<<<< HEAD
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('users');
=======
            $table->unsignedBigInteger('submission_id');
            $table->foreign('submission_id')
                ->references('id')
                ->on('submissions');
>>>>>>> 1db6c974877617732b70753a37ab1f1383d8bc05
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
    }
};
