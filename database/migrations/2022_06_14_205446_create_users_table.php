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
    // public function up()
    // {
    //     Schema::create('t_user', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('name');
    //         $table->string('email')->unique();
    //         $table->string('phone',15)->nullable();
    //         $table->boolean('role')->default(0);
    //         $table->boolean('multiple_role')->default(0);
    //         $table->string('m_address',255)->nullable();
    //         $table->text('m_avatar')->nullable();
    //         $table->string('password');
    //         $table->timestamp('email_verified_at')->nullable();
    //         $table->boolean('m_status')->default(0);
    //         $table->rememberToken();
    //         $table->timestamps();
    //     });
    // }

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
