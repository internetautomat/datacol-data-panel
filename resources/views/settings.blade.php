@extends('layouts.app')

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::open(['route' => 'settings.update', 'method' => 'post' ]) !!}

            <button class="btn btn-primary" type="submit">Save settings</button>

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!-- /.box -->


@stop
