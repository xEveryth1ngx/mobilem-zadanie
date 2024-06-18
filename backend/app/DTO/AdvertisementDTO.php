<?php

namespace App\DTO;

class AdvertisementDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $price,
        public ?array $files,
    ) {
    }
}
