<?php namespace App\Console\Commands;

use App\Extras\SendEmail;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VencimientoUnaSemana extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:vencimiento_una_semana';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vencimiento una semana';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SendEmail::aviso_vencimiento_una_semana();
    }

}
?>