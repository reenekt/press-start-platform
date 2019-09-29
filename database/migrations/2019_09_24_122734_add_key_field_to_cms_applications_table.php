<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyFieldToCmsApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_applications', function (Blueprint $table) {
            $table->string('app_key')->comment('Ключ приложения для взаимодействия с платформой');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_applications', function (Blueprint $table) {
            $table->dropColumn('app_key');
        });
    }
}
