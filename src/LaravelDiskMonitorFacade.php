<?php

namespace Adamhut\LaravelDiskMonitor;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Adamhut\LaravelDiskMonitor\LaravelDiskMonitor
 */
class LaravelDiskMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-disk-monitor';
    }
}
