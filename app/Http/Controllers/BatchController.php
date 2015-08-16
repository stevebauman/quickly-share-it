<?php

namespace App\Http\Controllers;

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
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
     * @return Response
     */
    public function store(BatchRequest $request)
    {
        $batch = $this->batch->newInstance();

        $batch->session_id = Session::getId();
        $batch->time = time();
        $batch->lifetime = $request->input('lifetime');
        $batch->name = $request->input('name');

        if($batch->save()) {
            flash()->success('Success!', 'Created batch. Start adding files!');

            return redirect()->route('batch.show', [$batch->session_id, $batch->time, $batch->name]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $sessionId $id
     *
     * @return Response
     */
    public function show($sessionId, $time, $name)
    {
        $batch = $this->batch->locate($sessionId, $time, $name);

        return view('pages.batch.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
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
     * @return Response
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
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
