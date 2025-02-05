<?php

namespace App\Providers;

use App\Services\Impl\TodolistServiceImpl;
use App\Services\TodolistService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TodoListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistService::class => TodolistServiceImpl::class
    ];

    public function provides(): array
    {
        return [TodolistService::class];
    }

    public function register(): void
    {
        // Jika menggunakan $singletons, Anda tidak perlu binding tambahan di sini.
    }

    public function boot(): void
    {
        //
    }
}
