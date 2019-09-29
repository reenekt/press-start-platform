<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetVendorsBaseStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('vendor_name')->nullable()->comment('Название вендора');
            $table->index('vendor_name');
        });

        Schema::table('cms_plugins', function (Blueprint $table) {
            $table->dropColumn('short_name');
            $table->dropColumn('class_name');

            $table->string('version', 32)->comment('Версия');
            $table->string('vendor')->nullable()->comment('Название вендора')->change();


            $table->foreign('vendor')
                ->references('vendor_name')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->dropColumn('vendor_name');
        });

        Schema::table('cms_plugins', function (Blueprint $table) {
            $table->dropForeign(['vendor']);

            $table->string('vendor')->comment('Создатель(-и) плагина. Вендор.')->change();

            $table->dropColumn('version');

            $table->string('short_name')->comment('Название класса без пространства имен');
            $table->string('class_name')->comment('Название класса с пространства имен');
        });
    }
}
