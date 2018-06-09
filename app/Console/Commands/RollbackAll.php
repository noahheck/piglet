<?php

namespace App\Console\Commands;

use App\Family;
use App\Service\FamilyConnectService;
use Illuminate\Console\Command;

class RollbackAll extends Command
{
    /**
     * @var FamilyConnectService
     */
    private $connectService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'piglet:family:rollback-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback the latest database migration for all family databases';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FamilyConnectService $connectService)
    {
        $this->connectService = $connectService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connectService = $this->connectService;
        $display        = $this;

        $this->line("Fetching families");
        $families = Family::all();

        $this->line("Beginning migration rollbacks");

        $families->each(function($family, $index) use ($connectService, $display) {
            $display->line("Rolling back migration for family {$family->id}...");
            $connectService->connectToFamily($family)->rollback();
            $display->line("Family {$family->id} rolled back");
        });

        $this->line("Migration rollbacks completed");

        $this->info("All migration rollbacks completed");
    }
}
