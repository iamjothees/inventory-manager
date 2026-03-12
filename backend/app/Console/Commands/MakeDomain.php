<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new domain';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Creating domain: {$name}");
        $this->makeDirectory("app/{$name}");
        $this->makeDirectory("app/{$name}/Database");
        $this->makeDirectory("app/{$name}/Database/Migrations");
        $this->makeDirectory("app/{$name}/Database/Seeders");
        $this->makeDirectory("app/{$name}/Database/Factories");
        $this->makeDirectory("app/{$name}/Dto");
        $this->makeDirectory("app/{$name}/Http");
        $this->makeDirectory("app/{$name}/Http/Controllers");
        $this->makeDirectory("app/{$name}/Http/Requests");
        $this->makeDirectory("app/{$name}/Http/Resources");
        $this->makeDirectory("app/{$name}/Models");
        $this->makeDirectory("app/{$name}/Providers");
        $this->makeDirectory("app/{$name}/Services");
        $this->makeDirectory("app/{$name}/Tests");
    }

    private function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
