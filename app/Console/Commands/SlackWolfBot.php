<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Slackwolf\Slackwolf;

class SlackWolfBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slackwolfbot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Slackwolf bot';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new Slackwolf())->run();
    }
}
