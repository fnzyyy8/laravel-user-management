<?php

namespace App\Providers;

use App\Service\Impl\TodolistServiceImpl;
use App\Service\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons =
        [TodolistService::class => TodolistServiceImpl::class];
    public function provides(): array
    {
         return [TodolistService::class];
    }

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
