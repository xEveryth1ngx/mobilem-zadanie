<?php

namespace App\Http\Controllers\Advertisement;

use App\DTO\AdvertisementDTO;
use App\Exception\Advertisement\AdvertisementNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\AdvertisementGeneralRequest;
use App\Services\Advertisement\AdvertisementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
        try {
            $advertisement = $this->service->findAdvertisementWithFiles($id);
        } catch (AdvertisementNotFoundException) {
            return response()->json([
                'message' => 'Advertisement not found!',
            ], Response::HTTP_NOT_FOUND);
        }

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

        try {
            $advertisement = $this->service->findAdvertisementWithFiles($id);
        } catch (AdvertisementNotFoundException) {
            return response()->json([
                'message' => 'Advertisement not found!',
            ], Response::HTTP_NOT_FOUND);
        }

        $advertisement = $this->service->updateAdvertisement($advertisement, $advertisementDTO);

        return response()->json($advertisement);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $advertisement = $this->service->findAdvertisementWithFiles($id);
        } catch (AdvertisementNotFoundException) {
            return response()->json([
                'message' => 'Advertisement deletion failed!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $this->service->deleteAdvertisement($advertisement);

        return response()->json([
            'message' => 'Advertisement deleted successfully!',
        ]);
    }
}
