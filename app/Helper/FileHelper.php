<?php

namespace App\Helper;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * Class FileUpload
 * @package App\Helper
 */
class FileHelper
{
    /**
     * If the uploaded file name matches with the name of the file in the uploaded directory,
     * the methods overrides the current file with the new file.
     *
     * @param UploadedFile $uploadedFile
     * @param string       $path
     * @param string       $fileSystem
     * @param bool         $assignNewName
     *
     * @return false|string
     * @throws \Exception
     */
    public function handle(UploadedFile $uploadedFile, $path = 'uploads', $assignNewName = true)
    {
        if ( $assignNewName ) {
            $extension = $uploadedFile->getClientOriginalExtension();
            $fileName  = sprintf('%s.%s', Str::random(32), $extension);
        } else {
            $fileName = $uploadedFile->getClientOriginalName();
        }
        try {
            $uploadedFile->storeAs(
                $path,
                $fileName,
            );

            return $fileName;

        } catch ( \Exception $e ) {
            return RedirectHelper::redirectBackStatus('warning', 'File not uploaded, error: ' . $e->getMessage());
        }
    }

    /**
     * @param $path Path
     * @param $filename Filename
     *
     * @return bool
     */
    public function deleteFile($path, $filename): bool
    {
        if (is_null($filename) ) {
            return false;
        }
        $imagePath = $path.'/'.$filename;
        try {
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
