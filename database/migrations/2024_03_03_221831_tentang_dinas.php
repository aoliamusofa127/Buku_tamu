<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tentang_dinas', function (Blueprint $table) {
            $table->id('dinas_id');
            $table->string('logo');
            $table->string('content');
            $table->string('sub_content');
            $table->string('link_youtube')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('kutipan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang_dinas');
    }
};