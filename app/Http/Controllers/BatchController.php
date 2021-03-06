<?php

namespace App\Http\Controllers;

use App\Jobs\CreateBatch;
use App\Jobs\CreateZip;
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
            return redirect()->route('batch.show', [$batch->uuid]);
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
            flash()->success('Success!', 'Created folder. Start adding files!');

            return redirect()->route('batch.show', [$batch->uuid]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     *
     * @return \Illuminate\View\View
     */
    public function show($uuid)
    {
        $batch = $this->batch->locate($uuid);

        return view('pages.batch.show', compact('batch'));
    }

    /**
     * Displays the form for editing the specified batch.
     *
     * @param string $uuid
     *
     * @return \Illuminate\View\View
     */
    public function edit($uuid)
    {
        $batch = $this->batch->locate($uuid);

        return view('pages.batch.edit', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BatchRequest  $request
     * @param  string        $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BatchRequest $request, $uuid)
    {
        $batch = $this->batch->locate($uuid);

        $batch->name = $request->input('name', $batch->name);
        $batch->description = $request->input('description', $batch->description);
        $batch->lifetime = $request->input('lifetime', $batch->lifetime);

        if($batch->save()) {
            flash()->success('Success!', 'Successfully updated folder.');

            return redirect()->route('batch.show', [$batch->uuid]);
        } else {
            flash()->error('Error!', 'There was an error updating this folder. Please try again.');

            return redirect()->route('batch.edit', [$batch->uuui]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($uuid)
    {
        //
    }

    /**
     * Zips all batch files and prompts the user to download it.
     *
     * @param string $uuid
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($uuid)
    {
        $batch = $this->batch->locate($uuid);

        if($batch->files->count() > 0) {
            $zip = $this->dispatch(new CreateZip($batch));

            if($zip && is_string($zip)) {
                return response()->download($zip);
            } else {
                flash()->error('Whoops!', 'Looks like we had an issue generating a ZIP.');

                return redirect()->back();
            }
        } else {
            flash()->error('Whoops!', 'There are no files to download.');

            return redirect()->back();
        }
    }
}
