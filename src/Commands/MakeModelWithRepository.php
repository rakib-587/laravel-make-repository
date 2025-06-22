<?php

namespace Rakib\MakeRepository\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;

class MakeModelWithRepository extends ModelMakeCommand
{
    protected function getOptions()
    {
        return array_merge(parent::getOptions(), [
            ['repo', null, InputOption::VALUE_NONE, 'Create a repository for the model'],
        ]);
    }

    public function handle()
    {
        parent::handle();

        if ($this->option('repo')) {
            $name = $this->qualifyClass($this->getNameInput());
            $model = class_basename($name);
            $this->createRepository($model);
        }
    }

    protected function createRepository(string $model)
    {
        $repositoryName = $model . 'Repository';
        $path = app_path("Repositories/{$repositoryName}.php");

        if (file_exists($path)) {
            $this->error("Repository {$repositoryName} already exists!");
            return;
        }

        File::ensureDirectoryExists(app_path('Repositories'));

        $stub = '';

        if (file_exists(base_path('stubs/repository.stub'))) {
            $stub = file_get_contents(base_path('stubs/repository.stub'));
        } else {
            $stub = file_get_contents(__DIR__ . '/../../stubs/repository.stub');
        }

        $stub = str_replace(['{{ ClassName }}', '{{ ModelName }}'], [$repositoryName, $model], $stub);

        File::put($path, $stub);

        $returnPath = "app/Repositories/{$repositoryName}.php";

        $this->components->info("Repository [{$returnPath}] created.");
    }
}
