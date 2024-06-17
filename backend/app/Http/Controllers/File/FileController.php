<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\FileRequest;
use \Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function getImage(FileRequest $request): BinaryFileResponse
    {
        $path = $request->validated(['path']);
        $path = explode('/', $path)[1];

        return response()->file(public_path('storage') . '/' . $path);
    }
}
