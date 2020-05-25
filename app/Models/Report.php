<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasUUID;

    protected $guarded = ['id'];
    protected $casts = [
        'options' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tiles()
    {
        return $this->morphMany(Tile::class, 'item');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
