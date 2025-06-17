<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class FileUpload
{
    /**
     * @throws \Exception
     */
    public function upload(UploadedFile $file, Model $model): string
    {
        if ($model->image) {
            if (Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }
        }
        $fileName = "id-". $model->id. "-".$file->getClientOriginalName();
        $link = $file->storeAs( $model->getTable(), $fileName, 'public');

        if (! $link) {
            throw new \Exception('Could not store project image');
        }
        return $link;
    }
}
