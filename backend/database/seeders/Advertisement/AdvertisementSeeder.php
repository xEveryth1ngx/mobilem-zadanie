<?php

namespace Database\Seeders\Advertisement;

use App\Models\Advertisement\Advertisement;
use App\Models\General\File;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::factory()
            ->count(3)
            ->has(File::factory()->count(2))
            ->create();
    }
}
