<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Jobs\CreateWebpJob;
use App\Services\ImageService;
use App\Services\JobService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;

class ImagesController extends BaseController
{
    private $prefix = null;

    public function upload(): ResponseInterface
    {
        /** @var $uploaded_file UploadedFileInterface  */
        $uploaded_file = $this->request->getUploadedFiles()['file'] ?? null;
        $setup = $this->postArgument('setup');

        if (!$uploaded_file) {
            return $this->jsonResponse([
                'message' => 'File Not Found'
            ]);
        }

        if ($uploaded_file->getError() !== UPLOAD_ERR_OK) {
            return $this->jsonResponse([
                'message' => 'File Upload Error'
            ]);
        }

        $file_name = $this->uniqueFileName($uploaded_file->getClientFilename());
        $file_path = \getUploadFilePath(\config('app.images_path_original')) . '/' . $file_name;
        $uploaded_file->moveTo($file_path);

        switch ($setup) {
            case 'editor':
                return $this->makeEditorImage($file_name);
        }

        return $this->jsonResponse([
            'link' => \config('app.images_path_original') . $this->getPrefix() . '/' . $file_name,
            'success' => 'OK'
        ]);
    }

    private function makeEditorImage(string $file_name): ResponseInterface
    {
        $options = [
            'width' => 840,
            'quality' => 75
        ];

        $original_file = \getUploadFilePath(\config('app.images_path_original')) . '/' . $file_name;
        $editor_file = \getUploadFilePath(\config('app.images_path_editor')) . '/' . $file_name;

        $success = (new ImageService)->process($original_file, $editor_file, $options);

        if (!$success) {
            return $this->jsonResponse([
                'message' => 'Can not process image'
            ]);
        }

        // generate also WebP version of image
        \container(JobService::class)->process([
            'job' => CreateWebpJob::class,
            'source' => $editor_file
        ]);

        return $this->jsonResponse([
            'link' => \config('app.images_path_editor') . $this->getPrefix() . '/' . $file_name,
            'success' => 'OK'
        ]);
    }

    private function uniqueFileName(string $file_name): string
    {
        $ext = \pathinfo($file_name, \PATHINFO_EXTENSION);
        $name = \pathinfo($file_name, \PATHINFO_FILENAME);

        $name = \strtolower(\trim(\preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $name = \mb_strimwidth($name, 0, 100, '', 'UTF-8');

        return $name . '-' . \bin2hex(\random_bytes(10)) . '.' . $ext;
    }

    public function getPrefix()
    {
        if (!$this->prefix) {
            $this->prefix = \getUploadPathPrefix();
        }

        return $this->prefix;
    }
}
