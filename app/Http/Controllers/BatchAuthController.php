<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Hashing\Hasher;
use App\Http\Requests\BatchUnlockRequest;
use App\Models\Batch;

class BatchAuthController
{
    /**
     * @var Batch
     */
    protected $batch;

    /**
     * @var Hasher
     */
    protected $hasher;

    /**
     * Constructor.
     *
     * @param Batch  $batch
     * @param Hasher $hasher
     */
    public function __construct(Batch $batch, Hasher $hasher)
    {
        $this->batch = $batch;
        $this->hasher = $hasher;
    }

    /**
     * Displays the password gate for the specified batch.
     *
     * @param string $uuid
     *
     * @return \Illuminate\View\View
     */
    public function gate($uuid)
    {
        $batch = $this->batch->locate($uuid);

        return view('pages.batch.gate.index', compact('batch'));
    }

    /**
     * Unlocks the batch and stores the batch ID
     * in the current session to allow a user
     * access.
     *
     * @param BatchUnlockRequest $request
     * @param string             $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlock(BatchUnlockRequest $request, $uuid)
    {
        $batch = $this->batch->locate($uuid);

        if($batch->unlock($request)) {
            flash()->success('Success!', 'Successfully unlocked folder.');

            return redirect()->route('batch.show', [$batch->uuid]);
        } else {
            return redirect()->back()->withErrors([
                'password' => 'Incorrect password. Try again!',
            ]);
        }
    }
}
