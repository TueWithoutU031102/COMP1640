<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->string('password');
            $table->string('phone_number')->default("");
            $table->date('DoB')->default("2023-02-13T10:10");
            $table->longText('image')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'email@gmail.com',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '1',
                'department_id' => NULL,

            ],
            [
                'name' => 'staff account',
                'email' => 'staff@gmail.com',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '2',
                'department_id' => '1',
            ],
            [
                'name' => 'QAM account',
                'email' => 'qam@gmail.com',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '4',
                'department_id' => '1',

            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
