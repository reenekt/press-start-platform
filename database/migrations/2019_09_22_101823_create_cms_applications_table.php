<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Название приложения на платформе');
            $table->string('url')->comment('URL приложения (домен)');
            $table->unsignedBigInteger('user_id')->comment('Хозяин системы');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cms_applications');
    }
}
