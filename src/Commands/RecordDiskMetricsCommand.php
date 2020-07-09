<?php

namespace Adamhut\DiskMonitor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Adamhut\DiskMonitor\Models\DiskMonitorEntry;

class RecordDiskMetricsCommand extends Command
{
    public $signature = 'disk-monitor:record-metrics';

    public $description = 'Record the Metric of the disk';

    public function handle()
    {
        collect(config('disk-monitor.disk_names'))
            ->each(function($diskName){
                $this->recordMetrics($diskName);
            });

        $this->comment('All done!');
    }

    protected function recordMetrics(string $diskName): void
    {
        $this->info("Recording metrics for disk `{$diskName}`..." );
        $disk = Storage::disk($diskName);

        $fileCount = count($disk->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $fileCount,
        ]);
        return ;
    }

}
