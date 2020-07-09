<?php

namespace Adamhut\DiskMonitor\Tests\Feature\Commands;

use Adamhut\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Adamhut\DiskMonitor\DiskMonitorFacade;
use Adamhut\DiskMonitor\Models\DiskMonitorEntry;
use Adamhut\DiskMonitor\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class RecordDiskMetricsCommandTest extends TestCase
{
    
    
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');

    }


    /** @test */
    public function it_will_record_the_file_count_for_a_disk()
    {
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(1, DiskMonitorEntry::all());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(0,$entry->file_count);

        Storage::disk('local')->put('test.txt', 'test');
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(2, DiskMonitorEntry::all());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(1, $entry->file_count);

    }

}