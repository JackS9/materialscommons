<?php

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

function fileType2($file)
{
    $excelTypes = [
        "application/vnd.ms-excel"                                          => true,
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => true,
        "text/csv"                                                          => true,
    ];

    $officeTypes = [
        // Powerpoint documents
        "application/vnd.ms-powerpoint"                                             => true,
        "application/vnd.openxmlformats-officedocument.presentationml.presentation" => true,

        // Word documents
        "application/msword"                                                        => true,
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"   => true,
    ];

    $imageTypes = [
        "image/gif"      => true,
        "image/jpeg"     => true,
        "image/png"      => true,
        "image/tiff"     => true,
        "image/x-ms-bmp" => true,
        "image/bmp"      => true,
    ];

    $convertibleImageTypes = [
        'image/tiff'     => true,
        'image/x-ms-bmp' => true,
        'image/bmp'      => true,
    ];

    $binaryTypes = [
        "application/octet-stream" => true,
    ];

    $pdfTypes = [
        "application/pdf" => true,
    ];

    if (array_key_exists($file->mime_type, $imageTypes)) {
        return "image";
    }

    if (array_key_exists($file->mime_type, $pdfTypes)) {
        return "pdf";
    }

    if (array_key_exists($file->mime_type, $excelTypes)) {
        return "excel";
    }

    if (array_key_exists($file->mime_type, $officeTypes)) {
        return "office";
    }

    if (array_key_exists($file->mime_type, $binaryTypes)) {
        return "binary";
    }

    return "text";
}

function fileExists($file)
{
    $filePath = Storage::disk('mcfs')->path(fileContentsPathPartial($file));
    return file_exists($filePath);
}

function fileContents($file)
{
    $filePathPartial = fileContentsPathPartial($file);
    try {
        return Storage::disk('mcfs')->get($filePathPartial);
    } catch (FileNotFoundException $e) {
        return 'No file';
    }
}

function fileContentsBase64($file)
{
    return base64_encode(fileContents($file));
}

function fileContentsPathPartial($file)
{
    $convertibleImageTypes = [
        'image/tiff'     => true,
        'image/x-ms-bmp' => true,
        'image/bmp'      => true,
    ];

    $officeTypes = [
        // Powerpoint documents
        "application/vnd.ms-powerpoint"                                             => true,
        "application/vnd.openxmlformats-officedocument.presentationml.presentation" => true,

        // Word documents
        "application/msword"                                                        => true,
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"   => true,
    ];

    $uuid = $file->uuid;
    if ($file->uses_uuid !== null) {
        $uuid = $file->uses_uuid;
    }

    $entries = explode('-', $uuid);
    $entry1 = $entries[1];

    $dirPath = "{$entry1[0]}{$entry1[1]}/{$entry1[2]}{$entry1[3]}";
    $fileName = $uuid;

    if (array_key_exists($file->mime_type, $convertibleImageTypes)) {
        $dirPath = $dirPath."/.conversion";
        $fileName = $fileName.".jpg";
    }

    if (array_key_exists($file->mime_type, $officeTypes)) {
        $dirPath = $dirPath."/.conversion";
        $fileName = $fileName.".pdf";
    }

    return "{$dirPath}/{$fileName}";
}