<?php

namespace Adamhut\DiskMonitor\Tests\Feature\Http\Controller;

use Adamhut\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Adamhut\DiskMonitor\Models\DiskMonitorEntry;
use Adamhut\DiskMonitor\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class DiskMetricsControllerTest extends TestCase
{
    


    /** @test */
    public function it_can_display_the_list_of_entries()
    {
        $this->withoutExceptionHandling();
        $this
            ->get('disk-monitor')
            ->assertOk();
    }

    
};
