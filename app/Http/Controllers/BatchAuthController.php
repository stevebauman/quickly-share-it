<?php

namespace App\Http\Controllers;

use App\Models\Batch;

class BatchAuthController
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

    public function unlock($uuid)
    {
        
    }
}
