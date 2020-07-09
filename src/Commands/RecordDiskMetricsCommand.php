<?php

namespace Adamhut\DiskMonitor\Commands;

use Adamhut\DiskMonitor\Models\DiskMonitorEntry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RecordDiskMetricsCommand extends Command
{
    public $signature = 'disk-monitor:record-metrics';

    public $description = 'Record the Metric of the disk';

    public function handle()
    {
        $this->comment('Recording metrics...');

        $diskName = config('disk-monitor.disk_name');

        $fileCount = count(Storage::disk($diskName)->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $fileCount,
        ]);

        $this->comment('All done!');
    }
}
