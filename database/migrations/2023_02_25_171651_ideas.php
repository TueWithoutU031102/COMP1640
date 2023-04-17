<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ideas');
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('isAnonymous');
            $table->bigInteger('views');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('categories');
            $table->unsignedBigInteger('submission_id');
            $table->foreign('submission_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('submissions');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('users');
            $table->timestamps();
        });

        DB::table('ideas')->insert(
            [
                [
                    'title' => 'Shape maker',
                    'isAnonymous' => false,
                    'views' => 5,
                    'description' => "For this competition, we could make the challenges be making many shapes such as triangle or hexagon with twist like using alternative lines or moving shapes.",
                    'category_id' => 2,
                    'submission_id' => 1,
                    'author_id' => 3,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
                [
                    'title' => 'Change MC',
                    'isAnonymous' => false,
                    'views' => 5,
                    'description' => 'For the upcoming competition, I propose that instructor Ha Le becomes the MC due to his experience in IT and his charisma. ',
                    'category_id' => 1,
                    'submission_id' => 1,
                    'author_id' => 3,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
                [
                    'title' => 'More tables',
                    'isAnonymous' => false,
                    'views' => 5,
                    'description' => 'One of the main complaints we received was that there werent enough to accommodate students so I think this is a good addition.',
                    'category_id' => 3,
                    'submission_id' => 2,
                    'author_id' => 4,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
                [
                    'title' => 'ABC Gaming company',
                    'isAnonymous' => false,
                    'views' => 5,
                    'description' => 'This company has a good reputation for educational visits from other universities so this is a good chance for students interested in game development.',
                    'category_id' => 2,
                    'submission_id' => 3,
                    'author_id' => 5,
                    'created_at' => '2023-07-04',
                    'updated_at' => '2023-07-04',
                ],
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
        Schema::dropIfExists('ideas');
    }
};
