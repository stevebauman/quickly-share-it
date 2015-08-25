<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     * The uploads table.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The fillable upload fields.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'size',
        'path',
    ];

    /**
     * Returns the complete file path of the upload.
     *
     * @return string
     */
    public function getCompletePath()
    {
        $storage = config('filesystems.disks.local.root');

        return $storage . DIRECTORY_SEPARATOR . $this->path;
    }

    /**
     * Returns the HTML icon of the upload.
     *
     * @return string
     */
    public function getIcon()
    {
        $mime = $this->type;

        return view('partials.mime', compact('mime'))->render();
    }

    /**
     * Returns the textual file size of the upload.
     *
     * @return string
     */
    public function getTextualFileSize()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($this->size, 0);

        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));

        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
