<?php

namespace Rakib\MakeRepository;

use Illuminate\Support\ServiceProvider;
use Rakib\MakeRepository\Commands\MakeRepository;
use Rakib\MakeRepository\Commands\MakeModelWithRepository;

class MakeRepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepository::class,
                MakeModelWithRepository::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../stubs/repository.stub' => base_path('stubs/repository.stub'),
        ], 'make-repository-stubs');
    }
}
