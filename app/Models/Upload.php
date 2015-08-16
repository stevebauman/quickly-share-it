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
}
