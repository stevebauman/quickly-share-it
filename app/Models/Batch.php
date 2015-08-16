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
     * Creates a new file attached to the current batch.
     *
     * @param string $path
     * @param string $name
     *
     * @return Upload
     */
    public function addFile($path, $name)
    {
        return $this->files()->create([
            'path' => $path,
            'name' => $name,
        ]);
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
