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
                ->cascadeOnDelete()
                ->references('id')
                ->on('departments');
            $table->string('password');
            $table->string('phone_number')->default("");
            $table->date('DoB')->default("2002-02-13");
            $table->longText('image')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('roles');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'goodiwebsite@gmail.com',
                'password' => Hash::make('123456'),
                'image' => 'images/default-avatar.jpg',
                'role_id' => '1',
                'DoB' => '2023-04-17',
                'phone_number' => '0912387645',
                'department_id' => NULL,
                'created_at' => '2023-18-04',
                'updated_at' => '2023-18-04',

            ],
            [
                'name' => 'Vu Nguyen Duc Tue',
                'email' => 'tuevndgch200058@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '3',
                'DoB' => '2002-03-11',
                'phone_number' => '0393608622',
                'department_id' => '1',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Do Quoc Viet',
                'email' => 'vietdqgch18237@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '1',
                'DoB' => '2000-03-11',
                'phone_number' => '0123456789',
                'department_id' => NULL,
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Nguyen Minh Quang',
                'email' => 'quangnmgch200003@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '3',
                'DoB' => '2002-03-01',
                'phone_number' => '0213456789',
                'department_id' => '1',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Nguyen Minh Hieu',
                'email' => 'hieunmgch200329@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '3',
                'DoB' => '2002-07-08',
                'phone_number' => '0369782002',
                'department_id' => '1',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Vu Hien Vinh',
                'email' => 'vinhvhgch200196@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '4',
                'DoB' => '2002-12-30',
                'phone_number' => '0869662310',
                'department_id' => NULL,
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Nguyen Nghi Binh',
                'email' => 'binh312@gmail.com',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '2',
                'DoB' => '1999-10-26',
                'phone_number' => '0934231166',
                'department_id' => '2',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => 'Luu The Chien',
                'email' => 'ltchien123@gmail.com',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '2',
                'DoB' => '2000-01-13',
                'phone_number' => '0948516358',
                'department_id' => '2',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => "Tran Huong Lan",
                'email' => 'lanthgdh200152@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '3',
                'DoB' => '2002-10-18',
                'phone_number' => '0326934322',
                'department_id' => '3',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ],
            [
                'name' => "Nguyen Bao Ngoc",
                'email' => 'ngocnbgbh210636@fpt.edu.vn',
                'password' => Hash::make("123456"),
                'image' => "images/default-avatar.jpg",
                'role_id' => '3',
                'DoB' => '2003-02-03',
                'phone_number' => '0982520777',
                'department_id' => '2',
                'created_at' => '2023-07-04',
                'updated_at' => '2023-07-04',
            ]
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
