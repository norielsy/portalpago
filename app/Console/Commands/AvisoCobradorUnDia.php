<?php namespace App\Console\Commands;

use App\Extras\SendEmail;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class AvisoCobradorUnDia extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:aviso_cobrador_un_dia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'un día de vencimiento cobros';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SendEmail::aviso_cobrador_nuevo_vencimiento_un_dia();
    }

}
?>
