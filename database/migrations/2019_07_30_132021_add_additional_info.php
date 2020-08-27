<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dress_number')->nullable()->change();
            $table->string('parking_card')->nullable();
            $table->string('responsibility')->nullable();
            $table->string('licence')->nullable();
            $table->string('certificate')->nullable();
            $table->string('clubs', '300')->nullable();
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
            $table->dropColumn('parking_card');
            $table->dropColumn('responsibility');
            $table->dropColumn('licence');
            $table->dropColumn('certificate');
            $table->dropColumn('clubs');
        });
    }
}
