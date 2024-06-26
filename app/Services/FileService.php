<?php

namespace App\Services;

use App\Enums\StorageType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

final class FileService
{
    /**
     * Сохраняет файл.
     *
     * @param  UploadedFile  $file  Файл для сохранения.
     * @param  StorageType  $storage  Тип хранилища.
     * @param  string  $disk  Диск, на котором нужно сохранить файл. По умолчанию 'public'.
     * @return string Путь к сохраненному файлу.
     *
     * @throws UploadException Если файл недействителен.
     */
    public function saveFile(UploadedFile $file, StorageType $storage, string $disk = 'public'): string
    {
        if (! $file->isValid()) {
            throw new UploadException();
        }

        if (Str::contains($file->getMimeType(), 'image')) {
            $directory = "images/$storage->value/".Carbon::now()->format('Y/m/d');
        } else {
            $directory = "files/$storage->value/".Carbon::now()->format('Y/m/d');
        }

        $fileName = Carbon::now()->timestamp.'_'.$file->getClientOriginalName();

        return Storage::disk($disk)->putFileAs($directory, $file, $fileName);
    }

    public function deleteFile(string $path, string $disk = 'public'): bool
    {
        if (! Str::contains($path, 'tmp')) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }

    public function updateFile(File|UploadedFile $file, StorageType $storageType, ?string $oldFile = null, string $disk = 'public'): string
    {
        $imageUrl = $this->saveFile($file, $storageType, $disk);

        if ($oldFile) {
            $this->deleteFile($oldFile);
        }

        return $imageUrl;
    }

    public function deleteFiles(array $files, string $disk = 'public'): void
    {
        foreach ($files as $file) {
            $this->deleteFile($file, $disk);
        }
    }

    public function getFileUrl(string $path, string $disk = 'public'): string
    {
        if ($this->checkFile($path)) {
            return Storage::disk($disk)->url($path);
        }

        return '';
    }

    public function getFileName(string $path, string $disk = 'public'): string
    {
        if (! Storage::disk($disk)->exists($path)) {
            return '';
        }

        $fileName = File::basename($path);

        return Str::after($fileName, '_');
    }

    public function syncFiles(Collection|array $currentFiles, Collection|array $loadedFiles, string $disk = 'public'): void
    {
        if (is_array($currentFiles)) {
            $currentFiles = collect($currentFiles);
        }

        $syncedFiles = $currentFiles->diff($loadedFiles);

        if ($syncedFiles->isNotEmpty()) {
            $syncedFiles->each(function ($file) use ($disk) {
                $this->deleteFile($file, $disk);
            });
        }
    }

    public function downloadFile(string $path, ?string $name = null): BinaryFileResponse|RedirectResponse
    {
        $path = urldecode($path);

        if ($this->checkFile($path)) {
            $file_path = Storage::disk('public')->path($path);

            if ($name === null) {
                $name = $this->getFileName($path);
            }

            return Response::download($file_path, $name);
        }

        return Redirect::back();
    }

    public function checkFile(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->fileExists($path);
    }
}
