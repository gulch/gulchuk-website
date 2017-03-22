<?php

namespace Gulchuk\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UploadedFileInterface;
use Illuminate\Support\Str;
use Gulchuk\Controllers\BaseController;

class ImagesController extends BaseController
{
    private $prefix = null;

    public function upload(): ResponseInterface
    {
        /** @var UploadedFileInterface $uploaded_file */
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
        $file_path = $this->getFilePath(config('images_path_original')) . $file_name;
        $uploaded_file->moveTo($file_path);

        // TODO: do awesome stuff...

        return $this->jsonResponse([
            'link' => config('images_path_original') . $this->getPrefix() . $file_name,
            'success' => 'OK'
        ]);
    }

    private function getPrefix()
    {
        if (!$this->prefix) {
            $this->prefix = date('/Y/m');
        }

        return $this->prefix;
    }

    private function getFilePath(string $path, string $prefix = ''): string
    {
        $prefix = $prefix ?: $this->getPrefix();

        $file_path = $_SERVER['DOCUMENT_ROOT'] . $path . $prefix;

        if (!file_exists($file_path)) {
            mkdir($file_path, 750, true);
        }

        return $file_path;
    }

    private function uniqueFileName(string $file_name): string
    {
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $name = pathinfo($file_name, PATHINFO_FILENAME);

        $name = Str::limit($name, 100, '');

        return Str::lower(Str::slug($name) . '-' . uniqid() . '.' . $ext);
    }
}