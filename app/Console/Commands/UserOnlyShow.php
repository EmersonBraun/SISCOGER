<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\administracao\UserRepository;
use App\Repositories\administracao\RoleRepository;

class UserOnlyShow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:only-show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Users (Not Admin) turn in visualization mode';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $user;
    protected $role;
    public function __construct(
        UserRepository $user,
        RoleRepository $role
    )
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->user->notAdmin();
        foreach ($users as $user) {
            $user->assignRole('provisorio');
            $this->info("Alterada permissão para provisório");
        }
    }
}
