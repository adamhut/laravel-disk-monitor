<?php

namespace Adamhut\DiskMonitor;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Adamhut\DiskMonitor\DiskMonitor
 */
class DiskMonitorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-disk-monitor';
    }
}
