<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\OperationController;

class Instagram extends Command
{
    public $operation;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Feed Instaram by Tags';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->operation = new OperationController();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->operation->getOwnMedia() == false) {
            return 'Error';
        }
    }
}
