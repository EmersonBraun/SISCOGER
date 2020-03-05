<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use File;
use DB;

use App\Repositories\FileUpload\FileUploadRepository;
class FilesEject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:roolback-bd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roolbacking bd (for deleted files)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $repository;
    protected $tableAltereds = [];
    public function __construct(FileUploadRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = $this->repository->newFiles();
        $bar = $this->output->createProgressBar(count($files));
        $bar->start();
        foreach ($files as $file) {
            $this->update($file);
            $this->addAltered($file['proc']);
            $bar->advance();
        }
        $bar->finish();
        $this->info("Completed!");
        $this->info(implode(', ',$this->tableAltereds));
    }

    public function update($file)
    {
        try {
            $proc = DB::table($file['proc'])->where('id_'.$file['proc'],$file['id_proc'])->update([$file['campo'] => null]);
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            //throw $th;
        }
    }

    public function addAltered($proc)
    {
        if(!in_array($proc,$this->tableAltereds)) array_push($this->tableAltereds, $proc);
    }
}
