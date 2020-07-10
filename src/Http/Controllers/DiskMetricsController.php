<?php 
namespace Adamhut\DiskMonitor\Http\Controllers;

use Adamhut\DiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController {    

    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();   

        return view('disk-monitor::entries',compact('entries'));
    }
}
