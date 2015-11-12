<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/****** THIS IS WHAT WE SHOULD DO IN PRODUCTION TO MODIFY A DATABASE TABLE IN PRODUCTION ***** <-//
    IN LOCALHOST WE JUST MAKE A ROLLBACK
    with --table=articles to include boilerplate code
*/
class AddExcerptToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->text('excerpt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('excerpt');
        });
    }
}
