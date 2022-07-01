<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMessageHistoriesTable.
 */
class CreateMessageHistoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_histories', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('appPackageName', 100);
            $table->string('messengerPackageName', 100);
            $table->string('sender', 50);
            $table->text('message');
            $table->string('ruleId', 50);
            $table->boolean('isTestMessage');
            $table->softDeletes();
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
		Schema::drop('message_histories');
	}
}
