<?php

namespace App\Models\General;

use App\Models\Advertisement\Advertisement;
use Database\Factories\General\FileFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'advertisement_id'];

    public function advertisements(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }

    protected static function newFactory(): Factory
    {
        return FileFactory::new();
    }
}
