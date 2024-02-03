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
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned(); // لتدل على ان الرقم ايجابي حصرا


            $table->string('city');
            $table->string('gender');

            $table->longText('bio');
            $table->longText('facebook');

            $table->timestamps();

            // المفاح الاجنبي موجود في العمود
            // id
            // في جدول ااسمو
            // users

            //عندما يتم الحذف لمستخدم من جدول المستخدمين قم بحذف فوري للبروفايل الخاص به

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
