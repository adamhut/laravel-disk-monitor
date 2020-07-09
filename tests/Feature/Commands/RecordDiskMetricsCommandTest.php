<?php

namespace Adamhut\DiskMonitor\Tests\Feature\Commands;

use Adamhut\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Adamhut\DiskMonitor\Models\DiskMonitorEntry;
use Adamhut\DiskMonitor\Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class RecordDiskMetricsCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        Storage::fake('another_disk');

    }


    /** @test */
    public function it_will_record_the_file_count_for_a_single_disk()
    {
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(1, DiskMonitorEntry::all());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(0, $entry->file_count);

        Storage::disk('local')->put('test.txt', 'test');
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(2, DiskMonitorEntry::all());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(1, $entry->file_count);
    }

    /** @test */
    public function t_will_record_the_file_count_for_a_multiple_disks()
    {
        config()->set('disk-monitor.disk_names',['local','another_disk']);
        Storage::disk('another_disk')->put('test.txt', 'test');

        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $entries = DiskMonitorEntry::get();
        $this->assertCount(2, DiskMonitorEntry::get());

        $this->assertEquals('local',$entries[0]->disk_name);
        $this->assertEquals(0, $entries[0]->file_count);

        $this->assertEquals('another_disk', $entries[1]->disk_name);
        $this->assertEquals( 1,$entries[1]->file_count );

       
        $this->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(4, DiskMonitorEntry::all());


    }

};
