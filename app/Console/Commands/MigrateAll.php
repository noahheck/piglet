<?php

namespace App\Console\Commands;

use App\Family;
use App\Service\FamilyConnectService;
use Illuminate\Console\Command;

class MigrateAll extends Command
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
    protected $signature = 'piglet:family:migrate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply database migrations for all family databases';

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

        $this->line("Beginning migrations");

        $families->each(function($family, $index) use ($connectService, $display) {
            $display->line("Migrating family {$family->id}...");
            $connectService->connectToFamily($family)->migrate();
            $display->line("Family {$family->id} migrated");
        });

        $this->line("Migrations completed");

        $this->info("All migrations completed");
    }
}
