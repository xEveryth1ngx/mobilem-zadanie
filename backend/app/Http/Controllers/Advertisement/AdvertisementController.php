<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\AdvertisementGeneralRequest;
use App\Models\Advertisement\Advertisement;
use App\Models\General\File;
use App\Services\File\FileService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index(): JsonResponse
    {
        $advertisements = Advertisement::get(['id', 'title', 'description', 'price']);

        return response()->json($advertisements);
    }

    public function show(int $id): JsonResponse
    {
        $advertisement = Advertisement::with('files')->find($id);

        return response()->json($advertisement->only(['id', 'title', 'description', 'price', 'files']));
    }

    public function store(AdvertisementGeneralRequest $request): JsonResponse
    {
        $advertisement = new Advertisement();
        $advertisement->title = $request->validated(['title']);
        $advertisement->description = $request->validated(['description']);
        $advertisement->price = $request->validated(['price']);
        $advertisement->save();

        $files = $request->file('files');

        if (!$files) {
            return response()->json($advertisement);
        }
        foreach ($files as $file) {
            $path = $file->store('public');

            $file = new File();
            $file->name = $path;
            $file->advertisement_id = $advertisement->id;
            $file->save();
        }

        return response()->json($advertisement);
    }

    public function update(int $id, AdvertisementGeneralRequest $request): JsonResponse
    {
        $advertisement = Advertisement::find($id);

        $advertisement->update($request->validated(['title', 'description', 'price']));

        return response()->json($advertisement);
    }
}
