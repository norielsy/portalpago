<?php namespace App\Console\Commands;

use App\Extras\SendEmail;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class VencimientoDeudaTres extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:vencimiento_tres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tres días atrás';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SendEmail::aviso_vencimiento_tres_dias();
    }

}
?>