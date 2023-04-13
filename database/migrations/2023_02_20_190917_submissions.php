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
        //
        Schema::dropIfExists('submissions');
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->datetime('startDate');
            $table->datetime('dueDate');
            $table->datetime('dueDateComment');
            $table->unsignedBigInteger('author_id')->default(3);
            $table->foreign('author_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
        DB::table('submissions')->insert(
            [
                [
                    'title' => 'Hackathons competition ideas',
                    'description' => 'For the upcoming Hackathon, we would like you to submit your own ideas for the event to ensure the participants interest and competitiveness.',
                    'startDate' => "2023-01-06 00:00:00",
                    'dueDate' => "2023-01-10 00:00:00",
                    'dueDateComment' => "2023-01-11 00:00:00",
                    'author_id' => 3,
                    'created_at' => '2023-07-04 00:00:00',
                    'updated_at' => '2023-07-04 00:00:00',
                ],
                [
                    'title' => 'Library renovation',
                    'description' => 'Since there were many complaints about the library, we would like to gather more ideas on how we should renovate the library before opening for business again without much delay.',
                    'startDate' => "2023-01-06 00:00:00",
                    'dueDate' => "2023-06-06 00:00:00",
                    'dueDateComment' => "2023-20-06 00:00:00",
                    'author_id' => 5,
                    'created_at' => '2023-07-04 00:00:00',
                    'updated_at' => '2023-07-04 00:00:00',
                ],
                [
                    'title' => 'Company visit',
                    'description' => 'We have contacted 3 companies that have time for our universitys company visit: ABC Gaming company, Toshiba Corporation and VNG Corporation. We would like to know which company to visit and what the ideal schedule would be for our students.',
                    'startDate' => "2023-15-06 00:00:00",
                    'dueDate' => "2023-17-06 00:00:00",
                    'dueDateComment' => "2023-20-06 00:00:00",
                    'author_id' => 4,
                    'created_at' => '2023-07-04 00:00:00',
                    'updated_at' => '2023-07-04 00:00:00',
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
        Schema::dropIfExists('submissions');
    }
};
