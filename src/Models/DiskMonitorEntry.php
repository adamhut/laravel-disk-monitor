<?php 
namespace Adamhut\DiskMonitor\Models;

use Illuminate\Database\Eloquent\Model;


class DiskMonitorEntry extends Model
{
    protected $guarded = [];    


    public static function last()
    {
        return static::orderByDesc('id')->first();
    }

}