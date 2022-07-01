<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasUUID;
    use HasFactory;

    protected $guarded = ['id', 'uuid'];
    protected $fillable = ['name', 'descriptiom', 'summary'];
}
