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

        // create folder in app directory
        $this->makeDirectory("app/{$name}");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Database");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Database/Migrations");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Database/Seeders");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Database/Factories");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Dto");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Http");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Http/Controllers");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Http/Requests");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Http/Resources");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Models");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Providers");

        // create folder in app directory
        $this->makeDirectory("app/{$name}/Services");
    }

    private function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}
