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
     * @param int    $batchUuid
     * @param int    $fileUuid
     *
     * @return \Illuminate\View\View
     */
    public function show($batchUuid, $fileUuid)
    {
        $batch = $this->batch->locate($batchUuid);

        $file = $batch->findFile($fileUuid);

        return view('pages.batch.files.show', compact('batch', 'file'));
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

    /**
     * Prompts the user to download the specified batch file.
     *
     * @param string $batchUuid
     * @param string $fileUuid
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($batchUuid, $fileUuid)
    {
        $batch = $this->batch->locate($batchUuid);

        $file = $batch->findFile($fileUuid);

        return response()->download($file->getCompletePath(), $file->name);
    }
}
