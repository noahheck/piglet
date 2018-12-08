<?php

namespace App\Service;


use Illuminate\Support\Facades\Storage;

class BackupFileService
{
    public function createBackupFile($backupFilename, $folderToBackup, $subFolders = [])
    {
        $tempFolderName = uniqid("backup_");

        $zipFilePath = $tempFolderName . '/content.zip';

        $backupDir = Storage::disk('backup');

        $backupDir->makeDirectory($tempFolderName);

        $fsZipFilePath = $backupDir->path($zipFilePath);



        $zip = new \ZipArchive();

        $zip->open($fsZipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderToBackup),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {

            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($folderToBackup) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();





        return $backupDir;
    }
}
