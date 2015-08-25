<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Http\Requests;

class BatchFileController extends Controller
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
     * Displays the specified batch file.
     *
     * @param int    $sessionId
     * @param int    $time
     * @param string $name
     * @param int    $fileId
     *
     * @return \Illuminate\View\View
     */
    public function show($sessionId, $time, $name, $fileId)
    {
        $batch = $this->batch->locate($sessionId, $time, $name);

        $file = $batch->findFile($fileId);

        return view('pages.batch.files.show', compact('batch', 'file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
    }
}
