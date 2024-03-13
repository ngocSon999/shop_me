<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait StorageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName): ?array
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $file_name = $file->getClientOriginalName();
            $ext = $file->extension();
            $filesize = $file->getSize();
            if (strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
                || strcasecmp($ext,'png') == 0){
                $image = $folderName . '-' . time() .'.'. $ext;
                $filepath = '';

                $directory = 'public/'.$folderName;
                if (!File::exists($directory)) {
                    if (!File::makeDirectory($directory, 0777, true, true)) {
                        throw new \Exception('Có lỗi xảy ra trong quá trình upload file');
                    }
                }

                if ($filesize < 7000000) {
                    $filepath = $file->storeAs('public/'.$folderName, $image);
                }

                return [
                    'file_name' => $file_name,
                    'file_path' => storage::url($filepath),
                ];
            }
        }

        return null;
    }

    public function storageTraitUploadMulti($file, $folderName): ?array
    {
        $file_name = $file->getClientOriginalName();
        $ext = $file->extension();

        if (strcasecmp($ext,'jpg') == 0 || strcasecmp($ext,'jpeg') == 0
            || strcasecmp($ext,'png') == 0) {
            $image = $folderName . '-' . time() .'.'. $ext;

            $filepath = $file->storeAs('public/'.$folderName, $image);

            return [
                'file_name' => $file_name,
                'file_path' => storage::url($filepath),
            ];
        }

        return null;
    }
}
