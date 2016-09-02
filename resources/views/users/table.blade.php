<table class="table table-responsive" id="users-table">
    <thead>
    <th>{{ t('users.table.username') }}</th>
    <th>{{ t('users.table.name') }}</th>
    <th>{{ t('users.table.email') }}</th>
    <th colspan="3">{{ t('users.table.actions') }}</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->login !!}</td>
            <td>{!! $user->name !!}
                <br>
                @foreach( $user->roles as $role )
                    <span class="label label-danger">
                       @lang('permissions.roles.'.$role->name)
                    </span>
                @endforeach

            </td>
            <td>{!! $user->email !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

                    @can('users.manage')
                        <a title="@lang('impersonate.start')" href="{!! url('users/'.$user->id.'/impersonate') !!}" class='btn btn-default btn-xs'>
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>

                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
