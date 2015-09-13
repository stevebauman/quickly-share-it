<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchLockedMiddleware
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
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->route('batch_uuid');

        if($uuid) {
            $batch = $this->batch->locate($uuid);

            if($batch->locked && ! $request->session()->has($uuid)) {
                return redirect()->route('batch.gate', [$batch->uuid]);
            }
        }

        return $next($request);
    }
}
