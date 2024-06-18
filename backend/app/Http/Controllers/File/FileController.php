<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use \Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller
{
    public function getImage(string $path): BinaryFileResponse
    {
        return response()->file(public_path('storage') . '/' . $path);
    }
}
