<?php

namespace App\Http\Controllers;

use App\Jobs\CreateBatch;
use App\Jobs\CreateZip;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Models\Batch;
use App\Http\Requests\BatchRequest;

class BatchController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //
    }

    /**
     * Generates a quick unique batch and redirects the user to the batch.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quick()
    {
        $batch = $this->dispatch(new CreateBatch());

        if($batch instanceof Batch) {
            return redirect()->route('batch.show', [$batch->session_id, $batch->time, $batch->name]);
        }

        flash()->error("Whoops!", "Looks like were having issues creating a batch! Try again later!");

        return redirect()->route('home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.batch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BatchRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BatchRequest $request)
    {
        $batch = $this->dispatch(new CreateBatch($request->name, $request->description, $request->lifetime));

        if($batch instanceof Batch) {
            flash()->success('Success!', 'Created batch. Start adding files!');

            return redirect()->route('batch.show', [$batch->session_id, $batch->time, $batch->name]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $sessionId
     * @param int    $time
     * @param string $name
     *
     * @return \Illuminate\View\View
     */
    public function show($sessionId, $time, $name)
    {
        $batch = $this->batch->locate($sessionId, $time, $name);

        return view('pages.batch.show', compact('batch'));
    }

    /**
     * Displays the form for editing the specified batch.
     *
     * @param string $sessionId
     * @param int    $time
     * @param string $name
     *
     * @return \Illuminate\View\View
     */
    public function edit($sessionId, $time, $name)
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

    /**
     * Zips all batch files and prompts the user to download it.
     *
     * @param string $sessionId
     * @param int    $time
     * @param string $name
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($sessionId, $time, $name)
    {
        $batch = $this->batch->locate($sessionId, $time, $name);

        $zip = $this->dispatch(new CreateZip($batch));

        return response()->download($zip);
    }
}
