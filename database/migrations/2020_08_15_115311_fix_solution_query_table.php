<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixSolutionQueryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solution_queries', function (Blueprint $table) {
            $table->string('business');
            $table->string('businessCategory');
            $table->longText('otherBusinessDetail');
            $table->dropColumn('otp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solution_queries', function (Blueprint $table) {
            $table->drop('business');
            $table->drop('businessCategory');
            $table->drop('otherBusinessDetail');
            $table->string('otp');
        });
    }
}
