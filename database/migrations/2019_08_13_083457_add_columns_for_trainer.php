<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsForTrainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('clubs')->nullable()->change();
            $table->string('title_before')->nullable();
            $table->string('title_after')->nullable();
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
            $table->string('clubs', '300')->nullable()->change();
            $table->dropColumn('title_before');
            $table->dropColumn('title_after');
        });
    }
}
