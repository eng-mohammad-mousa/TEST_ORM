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
        // هذا كلو نحنا منكتبو
        Schema::create('post_tag', function (Blueprint $table) {

            $table->increments('id');

            $table->integer("post_id");
            $table->integer("tag_id");


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
         // هذا كلو نحنا منكتبو
        Schema::dropIfExists('post_tag');
    }
};
