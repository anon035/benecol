<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMembershipTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('membership_totals', function (Blueprint $table) {
            Schema::dropIfExists('membership_totals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('membership_totals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('total');
            $table->timestamps();
        });
    }
}
