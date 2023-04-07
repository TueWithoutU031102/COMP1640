<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        DB::table('categories')->insert(
            [
                [
                    'title' => 'Teaching',
                    'description' => 'About instructors overall teaching skills and experience',
                    'author_id' => 4,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
                [
                    'title' => 'Activity',
                    'description' => 'About the universitys extra activities outside study periods',
                    'author_id' => 3,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
                [
                    'title' => 'Facility',
                    'description' => 'About school facilities provided for staff and students',
                    'author_id' => 5,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
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
