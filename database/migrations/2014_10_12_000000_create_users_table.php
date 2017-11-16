<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('status');
            $table->boolean('permission');
            $table->rememberToken();
            $table->timestamps();
        });

/**
 * Create administrator
 */
        DB::table('users')->insert(
            array(
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin123'),
                'status' => 'Active',
                'permission' => 1,
            )
        );
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
}
