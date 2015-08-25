@extends('layouts.master')

@section('title', 'Upload Files')

@section('content')

    <div class="text-center">

        <h1>{{ $file->name }}</h1>

        <p>
            <br>
        </p>

        <div class="fa-6">
            {!! $file->getIcon() !!}
        </div>

        <p>
            <br>
        </p>

        <div class="btn-group" role="group">

            <a class="btn btn-primary btn-lg" href="#">
                <i class="fa fa-download"></i>
                Download
            </a>

            <div class="btn-group" role="group">

                <button type="button" class="btn btn-lg btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="caret"></span>
                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            Edit
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-trash"></i> Delete
                        </a>
                    </li>

                </ul>
            </div>

        </div>

    </div>

@stop
