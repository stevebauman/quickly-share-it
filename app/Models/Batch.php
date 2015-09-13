<?php

namespace App\Models;

use App\Http\Requests\BatchUnlockRequest;
use Illuminate\Hashing\BcryptHasher;
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
        'uuid',
        'name',
        'description',
    ];

    /**
     * Locates a batch by its UUID.
     *
     * @param string $uuid
     *
     * @return Batch
     */
    public function locate($uuid)
    {
        return $this
            ->with(['files'])
            ->where(compact('uuid'))
            ->firstOrFail();
    }

    /**
     * Unlocks a batch by checking the specified
     * password against the batch password.
     *
     * @param BatchUnlockRequest $request
     *
     * @return bool
     */
    public function unlock(BatchUnlockRequest $request)
    {
        $hasher = new BcryptHasher();

        if($hasher->check($request->input('password'), $this->password)) {
            // Store the UUID in the users session so they can have
            // access to it for as long as the session exists
            $request->session()->put($this->uuid, $this->uuid);

            return true;
        }

        return false;
    }

    /**
     * Finds a batch file by the specified UUID.
     *
     * @param int $uuid
     *
     * @return Upload
     */
    public function findFile($uuid)
    {
        return $this->files()->where(compact('uuid'))->firstOrFail();
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
        $uuid = uuid();

        return $this->files()->create(compact('uuid', 'name', 'type', 'path', 'size'));
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
