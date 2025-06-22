<?php

namespace Rakib\MakeRepository\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $baseName = Str::studly(Str::replaceLast('Repository', '', $name));
        $className = $baseName . 'Repository';
        $modelName = $this->option('model') ?? $baseName;

        $repositoryPath = app_path("Repositories/{$className}.php");

        if (File::exists($repositoryPath)) {
            $this->error("Repository {$className} already exists!");
            return;
        }

        File::ensureDirectoryExists(app_path('Repositories'));

        $stub = '';

        if (file_exists(base_path('stubs/repository.stub'))) {
            $stub = file_get_contents(base_path('stubs/repository.stub'));
        } else {
            $stub = file_get_contents(__DIR__ . '/../../stubs/repository.stub');
        }

        $stub = str_replace(
            ['{{ ModelName }}', '{{ ClassName }}'],
            [$modelName, $className],
            $stub
        );

        File::put($repositoryPath, $stub);

        $returnPath = "app/Repositories/{$className}.php";

        $this->components->info("Repository [{$returnPath}] created successfully");
    }
}
