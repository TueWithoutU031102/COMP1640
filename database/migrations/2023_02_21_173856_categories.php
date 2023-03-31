<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });

        DB::table('categories')->insert([
                [
                    'title' => 'CAT2',
                    'description' => 'Cat1',
                    'author_id' => 3
                ],
                [
                    'title' => 'CAT3',
                    'description' => 'Cat1',
                    'author_id' => 3
                ],
                [
                    'title' => 'CAT1',
                    'description' => 'Cat1',
                    'author_id' => 3
                ]
            ]
        );
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
