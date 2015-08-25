<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    /**
     * The batches table.
     *
     * @var string
     */
    protected $table = 'batches';

    /**
     * The fillable batches table.
     *
     * @var array
     */
    protected $fillable = [
        'locked',
        'session_id',
        'lifetime',
        'time',
        'name',
        'description',
    ];

    /**
     * Locates a batch by its session ID, time and name.
     *
     * @param string $session_id
     * @param int    $time
     * @param string $name
     *
     * @return Batch
     */
    public function locate($session_id, $time, $name)
    {
        return $this
            ->with(['files'])
            ->where(compact('session_id', 'time', 'name'))
            ->firstOrFail();
    }

    /**
     * Finds a batch file by the specified ID.
     *
     * @param int $fileId
     *
     * @return Upload
     */
    public function findFile($fileId)
    {
        return $this->files()->findOrFail($fileId);
    }

    /**
     * Creates a new file attached to the current batch.
     *
     * @param string $name
     * @param string $type
     * @param int    $size
     * @param string $path
     *
     * @return Upload
     */
    public function addFile($name, $type, $size, $path)
    {
        return $this->files()->create(compact('name', 'type', 'path', 'size'));
    }

    /**
     * The hasMany files relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->belongsToMany(Upload::class, 'batch_uploads', 'batch_id');
    }
}
