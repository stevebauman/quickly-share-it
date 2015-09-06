<?php

namespace App\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use App\Http\Requests\BatchLockRequest;
use App\Models\Batch;

class LockBatch extends Job implements SelfHandling
{
    /**
     * @var Batch
     */
    protected $batch;

    /**
     * @var BatchLockRequest
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param Batch            $batch
     * @param BatchLockRequest $request
     */
    public function __construct(Batch $batch, BatchLockRequest $request)
    {
        $this->batch = $batch;
        $this->request = $request;
    }

    /**
     * Handles locking a batch to prevent further changes.
     *
     * @return bool
     */
    public function handle()
    {
        if($this->batch->locked) {
            // If the batch is already locked, we'll return false
            return false;
        } else {
            $this->batch->locked = true;

            if($this->request->has('password')) {
                $this->batch->password = bcrypt($this->request->input('password'));
            }

            return $this->batch->save();
        }
    }
}
