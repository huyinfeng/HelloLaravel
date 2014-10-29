<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pictures', function(Blueprint $table){
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->binary('image');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('comment_count');
			$table->timestamps();
			$table->engine = 'MyISAM';
		});
			DB::statement('ALTER TABLE pictures ADD FULLTEXT search(title, description)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pictures', function (Blueprint $table) {
            $table->dropIndex('search');
            $table->drop();
        });
	}

}
