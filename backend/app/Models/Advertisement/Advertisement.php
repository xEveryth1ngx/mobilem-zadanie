<?php

namespace App\Models\Advertisement;

use App\Models\General\File;
use Database\Factories\Advertisement\AdvertisementFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price'];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    protected static function newFactory(): Factory
    {
        return AdvertisementFactory::new();
    }
}
