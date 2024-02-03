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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("user_id");
            $table->string('title');
            $table->longText('content');
            $table->string("photo");

            $table->string("slug");
            // بدل ان يكون رابط البوست بهذا الشكل
            // https://laravel/posts/1
            // https://laravel/posts/2
            // https://laravel/posts/3
            // يكون بهذا الطريقة باستخدام السلاغ
            // https://laravel/posts/kafijzzzzkiwqtiii


            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
