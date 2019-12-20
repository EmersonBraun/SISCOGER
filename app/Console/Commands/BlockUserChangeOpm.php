<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\administracao\UserRepository;
use App\Repositories\PM\PolicialRepository;
use App\Services\BlockUserService;
class BlockUserChangeOpm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'block:user-change-opm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blocking users who switch OPM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $user;
    protected $pm;
    protected $block;
    public function __construct(
        UserRepository $user,
        PolicialRepository $pm,
        BlockUserService $block
    )
    {
        parent::__construct();
        $this->user = $user;
        $this->pm = $pm;
        $this->block = $block;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Implementado, mas comentado, descomentar quando resolver o problema do meta4");
        // $users = $this->user->all();
        // foreach ($users as $user) {
        //     $pm = $this->pm->get($user['rg']);
        //     $msg = "{$user['nome']} User OPM {$user['cdopm']} - Meta4 OPM {$pm['cdopm']}";
        //     if($user['cdopm'] !== $pm['cdopm']) {
        //         $block = $this->block($l['id'],"Mudança de OPM");
        //         if($block) $this->info("$msg -> Bloqueado");
        //         $this->info("$msg -> Não Bloqueado");
        //     }else {
        //         $this->info("$msg -> Não Bloqueado");           
        //     }
        // }
    }
}
