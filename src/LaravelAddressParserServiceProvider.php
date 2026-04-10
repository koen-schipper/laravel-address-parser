<?php

namespace KoenSchipper\AddressParser;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use KoenSchipper\AddressParser\Commands\LaravelAddressParserCommand;

class LaravelAddressParserServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-address-parser')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_address_parser_table')
            ->hasCommand(LaravelAddressParserCommand::class);
    }
}
