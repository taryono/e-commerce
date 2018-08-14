<?php

namespace App\Libraries;

use SplFileInfo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File as FileObject;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;

class File {
    protected $manager;
    public function __construct() {
        $this->manager = new ImageManager(array('driver' => 'imagick'));
    }

    /**
     * Store file on local disk.
     *
     * @param FileObject $file
     * @param string $path
     * @param string $prefix
     * @param string $sufix
     * @param int $minLength
     * @param int $maxLength
     * @return string
     */
    public static function storeLocalFile(FileObject $file, $path, $prefix = '', $sufix = '', $minLength = 10, $maxLength = 100) {
        $filename = File::generateLocalFilename($path, File::getFileExtension($file), $prefix, $sufix, $minLength, $maxLength);
        $filepath = File::createLocalDirectory("$path");

        return $file->move($filepath, $filename);
    }

    /**
     * Generate random unique filename on local disk.
     *
     * @param string $path
     * @param string $extension
     * @param string $prefix
     * @param string $sufix
     * @param int $minLength
     * @param int $maxLength
     * @return string
     */
    public static function generateLocalFilename($path, $extension, $prefix = '', $sufix = '', $minLength = 10, $maxLength = 100) {
        $random = str_random(mt_rand($minLength, $maxLength));
        $filename = "{$prefix}{$random}{$sufix}.{$extension}";

        if (is_file("{$path}/{$filename}")) {
            return File::generateLocalFilename($path, $extension, $prefix, $sufix, $minLength, $maxLength);
        }

        return $filename;
    }

    /**
     * Get local path from a file.
     *
     * @param string $filepath
     * @return string
     */
    public static function getLocalPath($filepath) {
        if ($filepath instanceOf FileObject) {
            $filepath = $filepath->getRealPath();
        }

        if (is_string($filepath)) {
            return substr($filepath, strlen(public_path()));
        }
    }

    /**
     * Get file content.
     *
     * @param mixed $file
     * @return resource
     */
    protected function getFileContent($file) {
        if ($file instanceOf SplFileInfo) {
            return file_get_contents($file);
        }
    }

    /**
     * Get file extension.
     *
     * @param mixed $file
     * @return string
     */
    protected static function getFileExtension($file) {
        if (is_string($file)) {
            return substr($file, strrpos($file, '.') + 1);
        }

        if ($file instanceOf UploadedFile) {
            return $file->getClientOriginalExtension();
        }

        if ($file instanceOf FileObject) {
            return $file->getExtension();
        }
    }

    /**
     * Create directory on local storage.
     *
     * @param string $path
     * @return string
     */
    public static function createLocalDirectory($path) {
        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        if (!is_writable($path)) {
            @chmod($path, 0777);
        }
        File::fsmodifyr($path);
        return $path;
    }
    
    public static function fsmodify($obj) {
       $chunks = explode('/', $obj);
       chmod($obj, is_dir($obj) ? 0777 : 0644);
       chown($obj, $chunks[2]);
       chgrp($obj, $chunks[2]);
    }


    public static function fsmodifyr($dir) 
    {
       if($objs = glob($dir."/*")) {        
           foreach($objs as $obj) {
               File::fsmodify($obj);
               if(is_dir($obj)) File::fsmodifyr($obj);
           }
       }

       return File::fsmodify($dir);
    }   
    
}
