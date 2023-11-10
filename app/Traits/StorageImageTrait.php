<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Storage; 

trait StorageImageTrait{
    public function storageTraitUpload($request, $fileName, $folderName)
    {
        if($request->hasFile($fileName)){
            $file = $request->$fileName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fileName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    public function storageTraitUploadMultiple($file, $folderName)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
    }
}
?>