<?php

namespace App\Http\Services;


class FileDownload
{
    public static function download($file)
    {
        // https://stackoverflow.com/a/8122372/12580861
        // https://www.tutorialrepublic.com/php-tutorial/php-file-download.php
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Type: application/force-download");
        header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($_SERVER['DOCUMENT_ROOT'] . $file));
        ob_clean();
        flush();
        readfile($_SERVER['DOCUMENT_ROOT'] . $file);
        exit;
    }
}
