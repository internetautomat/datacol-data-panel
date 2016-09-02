@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{{ t('users.users') }}</h1>
        <h1 class="pull-right">
            @can('users.manage')
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}"> {{ t('users.create')  }}</a>
            @endcan
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body table-responsive">
                @include('users.table')
            </div>
        </div>

        <div class=text-center>
            @include('adminlte-templates::common.paginate', ['records' => $users])
        </div>
    </div>
@endsection

