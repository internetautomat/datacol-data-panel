@extends('layouts.box')
@section('contentheader_title', t('permissions.Permissions'))
@section('contentheader_description', t('permissions.manage','Manage permissions'))

@section('xcontent')
    @parent

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>{{ trans('permissions.permission') }}</th>
            @foreach( \App\Models\Role::all() as $role )
                <th class="text-center">{{ t( 'permissions.roles.'.$role->name, $role->title ) }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>

        @foreach( \Silber\Bouncer\Database\Ability::all() as $permission)

            <tr>
                <td>{{ t('permissions.permissions.'.$permission->name) }}</td>

                @foreach( \App\Models\Role::all() as $role )
                    <td class="text-center">
                        {!! $role->abilities->keyBy('id')->has($permission->id) ? '<b>'.t('common.yes') : t('common.no') !!}
                    </td>
                @endforeach

            </tr>

        @endforeach

        </tbody>
    </table>


@stop