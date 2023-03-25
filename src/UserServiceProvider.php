<?php

namespace Kgalanos\User;

use Kgalanos\User\Commands\MakeUserCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UserServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-user')
            ->hasMigration('alter_laravel-user_table')
            ->hasCommand(MakeUserCommand::class);
    }
}
