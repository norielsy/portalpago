<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationModelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuracion', function(Blueprint $table)
		{
			$table->increments('idConfiguracion');
			$table->string('nombre_configuracion');
			$table->string('valor_configuracion');
			$table->timestamps();
			$table->unique('nombre_configuracion');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('configuration_models');
	}

}
