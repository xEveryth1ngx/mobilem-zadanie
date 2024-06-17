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
        $advertisement = Advertisement::with('files')->find($id)->get();
        $images = [];
        foreach ($advertisement->files as $file) {
            $images[] = Storage::get($file->name);
        }


        return response()->json($advertisement);
    }

    public function store(AdvertisementGeneralRequest $request): JsonResponse
    {
        $advertisement = new Advertisement();
        $advertisement->title = $request->validated(['title']);
        $advertisement->description = $request->validated(['description']);
        $advertisement->price = $request->validated(['price']);
        $advertisement->save();

        $files = $request->file('files');
        foreach ($files as $file) {
            $path = $file->store('images');

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
