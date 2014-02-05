<?php

use Illuminate\Database\Migrations\Migration;

class CreateAnchorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
            Schema::create('anchors',function($table){
                $table->increments('id');
                $table->string('anchor_text');
                $table->text('anchor_type');
                $table->integer('link_id');
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
		//
            Schema::drop('anchors');
	}

}