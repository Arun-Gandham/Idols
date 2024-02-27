<?php

namespace App\Traits;

trait FileUploadTrait
{
    public function uploadFile($path,$fileInput,$name)
    {
        if ($fileInput) {
            $fileName = $name . '.' . $fileInput->getClientOriginalExtension();;
            $fileInput->move(public_path($path), $fileName);
            return $path."/".$fileName;
        }
        return false;
    }
}