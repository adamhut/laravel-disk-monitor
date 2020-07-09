<?php
namespace Adamhut\DiskMonitor\Models;

use Illuminate\Database\Eloquent\Model;

class DiskMonitorEntry extends Model
{
    protected $guarded = [];


    protected $casts = [
        'file_count' => 'integer',
    ];


    public static function last()
    {
        return static::orderByDesc('id')->first();
    }
}
