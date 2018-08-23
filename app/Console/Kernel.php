<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\EmailPrueba',
		'App\Console\Commands\VencimientoDeudaTres',
		'App\Console\Commands\VencimientoUnaSemana',
		'App\Console\Commands\VencimientoDosSemanas',

		'App\Console\Commands\AvisoCobradorUnDia',
		'App\Console\Commands\AvisoCobradorTresDias',

	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')->hourly();
		//$schedule->command('email:vencimiento_uno')->everyFiveMinutes();
	}

}