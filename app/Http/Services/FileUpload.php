<?php

namespace App\Http\Services;

use Intervention\Image\ImageManager;

class FileUpload
{
    public static function UploadAndFitImage($file, $path, $name, $width, $height)
    {
        $path = trim($path, '\/') . "/";
        $name = trim($name, '\/') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                die("image resize : failed to create directory");
            }
        }
        is_writable($path);
        $manager = new ImageManager(array('driver' => 'GD'));
        $image = $manager->make($file['tmp_name'])->fit($width, $height);
        $image->save($path . $name);
        return '/' . $path . $name;
    }
    public static function uploadFile($file, $path, $name)
    {
        $path = trim($path, '\/') . "/";
        $name = trim($name, '\/') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                die("image upload : failed to create directory");
            }
        }
        is_writable($path);
        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
            return '/' . $path . $name;
        } else {
            error('attachments', 'there is problem in uploading file');
            return back();
        }
    }
    public static function removeFile($path)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $path);
        }
    }
}
