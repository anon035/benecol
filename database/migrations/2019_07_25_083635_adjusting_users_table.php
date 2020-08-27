<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdjustingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname');
            $table->string('registration_number')->unique();
            $table->string('phone_number');
            $table->integer('dress_number')->default(0);
            $table->boolean('has_suit')->default(false);
            $table->string('user_type')->default('player');
            $table->date('birth_date');
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
            $table->dropColumn('surname');
            $table->dropColumn('registration_number');
            $table->dropColumn('phone_number');
            $table->dropColumn('dress_number');
            $table->dropColumn('has_suit');
            $table->dropColumn('user_type');
            $table->dropColumn('birth_date');
        });
    }
}
