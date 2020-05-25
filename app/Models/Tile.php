<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Tile extends Model
{
    use HasUuid;

    protected $guarded = ['id'];

    private $chart = null;

    public function item()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    function setChart($chart)
    {
        $this->chart = $chart;
    }

    public function getChart()
    {
        return $this->chart;
    }
}
