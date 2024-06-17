<?php

namespace App\Services\File;

class FileService
{
    public function storeFile($file)
    {
        $storagePath = $this->generateStoragePath($file);

        return $file->store($storagePath);
    }

    private function generateStoragePath($file)
    {
        $basePath = 'public/images';
        $fileName = $this->generateUniqueFileName($file);

        return "{$basePath}/{$fileName}";
    }

    private function generateUniqueFileName($file)
    {
        return md5(uniqid() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
    }
}
