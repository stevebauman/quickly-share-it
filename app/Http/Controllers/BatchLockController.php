<?php

namespace App\Http\Controllers;

use App\Jobs\LockBatch;
use App\Models\Batch;
use App\Http\Requests\BatchLockRequest;

class BatchLockController extends Controller
{
    /**
     * @var Batch
     */
    protected $batch;

    /**
     * Constructor.
     *
     * @param Batch $batch
     */
    public function __construct(Batch $batch)
    {
        $this->batch = $batch;
    }

    /**
     * Locks a batch from modifications.
     *
     * @param BatchLockRequest $request
     * @param string           $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function perform(BatchLockRequest $request, $uuid)
    {
        $batch = $this->batch->locate($uuid);

        if($this->dispatch(new LockBatch($batch, $request))) {
            flash()->success('Success!', 'Your files have been locked.');

            return redirect()->back();
        } else {
            flash()->error('Error', 'This batch is already locked.');

            return redirect()->back();
        }
    }
}
