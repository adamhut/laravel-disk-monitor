<?php

namespace Adamhut\DiskMonitor;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Adamhut\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Adamhut\DiskMonitor\Http\Controllers\DiskMetricsController;

class DiskMonitorServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package):void
    {
        $package
            ->name('laravel-disk-monitor')
            ->hasViews()
            ->hasConfigFile()
            ->hasMigration('create_disk_monitor_table')
            ->hasCommands(RecordDiskMetricsCommand::class);



    }

    public function packageRegistered()
    {
        Route::macro('diskMonitor', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', DiskMetricsController::class)->name('disk-monitor');
            });
        });
    }

}
