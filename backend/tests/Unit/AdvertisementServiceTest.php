<?php

use App\DTO\AdvertisementDTO;
use App\Services\Advertisement\AdvertisementService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdvertisementServiceTest extends TestCase
{
    #[DataProvider('store_advertisement_data_provider')]
    public function test_store_advertisement(AdvertisementDTO $advertisementDTO): void
    {
        $advertisementService = new AdvertisementService();

        $advertisement = $advertisementService->storeAdvertisement($advertisementDTO);
        $this->assertModelExists($advertisement);
    }

    public static function store_advertisement_data_provider(): array
    {
        return [
            [
                new AdvertisementDTO(
                    'Title',
                    'Description',
                    100,
                    [],
                ),
            ],
            [
                new AdvertisementDTO(
                    'Title',
                    'Description',
                    100.02,
                    [],
                ),
            ],
        ];
    }
}
