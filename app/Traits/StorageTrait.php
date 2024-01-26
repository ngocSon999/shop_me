<?php

namespace App\Traits;

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

//                $directory = 'public/'.$folderName;
//                if (!Storage::exists($directory)) {
//                    Storage::makeDirectory($directory);
//                }

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
