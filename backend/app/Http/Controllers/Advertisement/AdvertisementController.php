<?php

namespace App\Http\Controllers\Advertisement;

use App\DTO\AdvertisementDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\AdvertisementGeneralRequest;
use App\Models\Advertisement\Advertisement;
use App\Models\General\File;
use App\Services\Advertisement\AdvertisementService;
use Illuminate\Http\JsonResponse;

class AdvertisementController extends Controller
{
    public function __construct(
        protected AdvertisementService $service,
    ) {
    }

    public function index(): JsonResponse
    {
        $advertisements = $this->service->getAllAdvertisements();

        return response()->json($advertisements);
    }

    public function show(int $id): JsonResponse
    {
        $advertisement = $this->service->findAdvertisementWithFiles($id);

        return response()->json($advertisement->only([
            'id', 'title', 'description', 'price', 'files',
        ]));
    }

    public function store(AdvertisementGeneralRequest $request): JsonResponse
    {
        $advertisementDTO = new AdvertisementDTO(
            $request->validated(['title']),
            $request->validated(['description']),
            $request->validated(['price']),
            $request->file('files'),
        );

        $advertisement = $this->service->storeAdvertisement($advertisementDTO);

        return response()->json($advertisement);
    }

    public function update(AdvertisementGeneralRequest $request, int $id): JsonResponse
    {
        $advertisementDTO = new AdvertisementDTO(
            $request->validated(['title']),
            $request->validated(['description']),
            $request->validated(['price']),
            $request->file('files'),
        );

        $advertisement = $this->service->findAdvertisementWithFiles($id);
        $advertisement = $this->service->updateAdvertisement($advertisement, $advertisementDTO);

        return response()->json($advertisement);
    }
}
