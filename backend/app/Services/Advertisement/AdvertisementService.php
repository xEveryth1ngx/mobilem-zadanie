<?php

namespace App\Services\Advertisement;

use App\DTO\AdvertisementDTO;
use App\Models\Advertisement\Advertisement;
use App\Models\General\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class AdvertisementService
{
    public function findAdvertisement(int $id): ?Advertisement
    {
        return Advertisement::find($id);
    }

    public function findAdvertisementWithFiles(int $id): ?Advertisement
    {
        return Advertisement::with('files')->find($id);
    }

    public function getAllAdvertisements(): Collection
    {
        return Advertisement::all();
    }

    public function storeAdvertisement(AdvertisementDTO $advertisementDTO): Advertisement
    {
        $advertisement = new Advertisement();

        $advertisement->title = $advertisementDTO->title;
        $advertisement->description = $advertisementDTO->description;
        $advertisement->price = $advertisementDTO->price;

        $advertisement->save();

        if (!$advertisementDTO->files) {
            return $advertisement;
        }

        $this->storeAdvertisementFiles($advertisement, $advertisementDTO->files);


        return $advertisement;
    }

    public function updateAdvertisement(Advertisement $advertisement, AdvertisementDTO $advertisementDTO): Advertisement
    {
        $this->deleteAdvertisementFiles($advertisement);

        $advertisement->update([
            'title' => $advertisementDTO->title,
            'description' => $advertisementDTO->description,
            'price' => $advertisementDTO->price,
        ]);

        if (!$advertisementDTO->files) {
            return $advertisement;
        }

        $this->storeAdvertisementFiles($advertisement, $advertisementDTO->files);

        return $advertisement;
    }

    public function deleteAdvertisement(Advertisement $advertisement): void
    {
        $this->deleteAdvertisementFiles($advertisement);

        $advertisement->delete();
    }

    private function deleteAdvertisementFiles(Advertisement $advertisement): void
    {
        foreach ($advertisement->files as $file) {
            $path = $file->name;
            Storage::delete($path);

            $file->delete();
        }
    }

    private function storeAdvertisementFiles(Advertisement $advertisement, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('public');

            $file = new File();
            $file->name = $path;
            $file->advertisement_id = $advertisement->id;
            $file->save();
        }
    }
}
