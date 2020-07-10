<?php

namespace Adamhut\DiskMonitor;

use Adamhut\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Adamhut\DiskMonitor\Http\Controllers\DiskMetricsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiskMonitorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this
            ->registerPublishables()
            ->registerCommands()
            ->registerRoutes()
            ->registerViews();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/disk-monitor.php', 'disk-monitor');
    }
    
    public function registerPublishables(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }

        $this->publishes([
            __DIR__ . '/../config/disk-monitor.php' => config_path('disk-monitor.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/disk-monitor'),
        ], 'views');

        if (! class_exists('CreateDiskMonitorTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_disk_monitor_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_disk_monitor_table.php'),
            ], 'migrations');
        }

        return $this;
    }

    public function registerCommands(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }
        
        $this->commands([
            RecordDiskMetricsCommand::class,
        ]);
        
        return $this;
    }

    public function registerRoutes(): self
    {
        Route::macro('diskMonitor', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::get('/', DiskMetricsController::class)->name('disk-monitor');
            });
        });

        return $this;
    }


    public function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'disk-monitor');

        return $this;
    }
}
