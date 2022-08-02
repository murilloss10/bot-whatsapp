<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSaveSessionsTable.
 */
class CreateSaveSessionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('save_sessions', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('user_id');
            $table->string('sender', 50);
            $table->string('session_name', 50)->nullable();
            $table->boolean('is_active');
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
		Schema::drop('save_sessions');
	}
}
