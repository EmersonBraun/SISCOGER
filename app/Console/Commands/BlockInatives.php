<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\log\logRepository;
use App\Services\BlockUserService;
class BlockInatives extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'block:inatives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Block users with no enter in sistem, more then 40 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $log;
    protected $block;
    public function __construct(
        logRepository $log,
        BlockUserService $block
    )
    {
        parent::__construct();
        $this->log = $log;
        $this->block = $block;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Get acess users');

        $last_acess = $this->log->ultimoAcesso();
        $limit_time = config('sistema.tempo_inatividade');
        foreach ($last_acess as $l) {
            $msg = $l['rg'].": ".$l['qtd_dias']." dias sem acesso";
            if($l['qtd_dias'] > $limit_time) {
                $block = $this->block($l['id'],"Mais de $limit_time sem acesso");
                if($block) $this->info("$msg -> Bloqueado");
                $this->info("$msg -> Não Bloqueado");
            } else {
                $this->info("$msg -> Não Bloqueado");
            }
        }
    }
}
