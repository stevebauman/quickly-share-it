@extends('layouts.master')

@section('title', 'Upload Files')

@section('content')

    @unless($batch->locked)
        @include('pages.batch.partials.upload')
        @include('pages.batch.partials.lock')
    @endunless

    <h2>Current Files:</h2>

    <hr>

    <div class="row">

        <div class="col-md-12">

            <div class="btn-group" role="group">
                @unless($batch->locked)
                    <a href="{{ route('batch.edit', [$batch->uuid]) }}" class="btn btn-default">
                        <i class="fa fa-edit"></i>
                        Edit
                        <span class="hidden-xs">Details</span>
                    </a>
                    <a href="#lock-modal" class="btn btn-default" data-toggle="modal" data-target="#lock-modal">
                        <i class="fa fa-lock"></i>
                        Lock
                        <span class="hidden-xs">Folder</span>
                    </a>
                @endunless
                <a href="{{ route('batch.download', [$batch->uuid]) }}" class="btn btn-default">
                    <i class="fa fa-download"></i>
                    Download
                    <span class="hidden-xs">All (.Zip)</span>
                </a>
            </div>

            <div class="btn-group pull-right" role="group">
                <a href="{{ route('batch.show', [$batch->uuid, 'view' => 'list']) }}" class="btn btn-default {{ (Input::get('view') === 'list' ? 'active' : null) }}">
                    <i class="fa fa-list"></i>
                </a>
                <a href="{{ route('batch.show', [$batch->uuid, 'view' => 'tabs']) }}" class="btn btn-default {{ (Input::get('view') === 'tabs' ? 'active' : null) }}">
                    <i class="fa fa-th-large"></i>
                </a>
            </div>

        </div>

    </div>

    <div class="row">

        <p></p>

        <div class="col-md-12">

            {{ $batch->description }}

            @if($batch->files->count() > 0)

                @if(Input::get('view') === 'tabs')

                    @include('pages.batch.files._tabs')

                @else

                    @include('pages.batch.files._list')

                @endif

            @else

                <h4 class="text-muted hidden-xs">There are currently no files inside this folder.</h4>
                <h5 class="text-muted visible-xs">There are current no files inside this folder</h5>

            @endif

        </div>

    </div>

@stop
