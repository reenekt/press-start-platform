<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsPluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_plugins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vendor')->comment('Создатель(-и) плагина. Вендор.');
            $table->string('package')->comment('Пакет');
            $table->string('short_name')->comment('Название класса без пространства имен');
            $table->string('class_name')->comment('Название класса с пространства имен');
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
        Schema::dropIfExists('cms_plugins');
    }
}
